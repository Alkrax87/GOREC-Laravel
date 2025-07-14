<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Inversion;
use App\Models\Especialidad;
use App\Models\Fase;
use App\Models\AvanceEspecialidadLog;
use App\Models\AvanceInversionLog;
use App\Models\AsignacionProfesional;
use App\Models\User;
use Carbon\Carbon;
use Auth;

class EspecialidadController extends Controller
{
    public function index(Request $request)
    {
        // LLamamos a la funcion para calcular avance especialidad e inversion
        $this->calcularAvanceTotalEspecialidad();
        $this->calcularAvanceTotalInversión();

        // Cargamos los datos de inversion filtrador en base al usuario logeado
        $user = Auth::user();
        if ($user->isAdmin) {
            /*
                Si el usuario es administrador, carga todas las inversiones
            */
            $inversiones = Inversion::all();
            $usuarios = User::whereNotNull('email')->where('idUsuario', '!=', 1)->get();
            $especialidades = Especialidad::all();

        } else {
            /*
                Si no es administrador, carga las inversiones asignadas como Responsable,
                Coordinador y aquellas en las que ha sido asignado como profesional
            */
            $inversionesResponsable = Inversion::where('idUsuario', $user->idUsuario)->get();
            $inversionesCoordinador = Inversion::whereHas('coordinadores', function ($query) use ($user) {
                $query->where('users.idUsuario', $user->idUsuario);
            })->get();
            $inversionesProfesional = Inversion::whereHas('profesional', function ($query) use ($user) {
                $query->where('idUsuario', $user->idUsuario);
            })->get();

            // Combinamos las inversiones asignadas al usuario
            $inversiones = $inversionesResponsable
                ->merge($inversionesCoordinador)
                ->merge($inversionesProfesional)
                ->unique('idInversion');
            //$inversiones = Inversion::where('idUsuario', $user->idUsuario)->get();
            $inversionIds = $inversiones->pluck('idInversion');
            $especialidades = Especialidad::whereIn('idInversion', $inversionIds)->get();
            //$especialidadIds = $especialidades->pluck('idEspecialidad');
            // Si es profesional → solo las especialidades que le han sido asignadas (de esas inversiones)
            $especialidadesProfesional = Especialidad::whereHas('usuarios', function ($query) use ($user) {
                $query->where('especialidad_users.idUsuario', $user->idUsuario);
            })->whereIn('idInversion', $inversionIds)->get();

            // Si es SOLO profesional (no responsable ni coordinador), sobrescribir la lista
            $esResponsable = $inversionesResponsable->isNotEmpty();
            $esCoordinador = $inversionesCoordinador->isNotEmpty();

            if (!$esResponsable && !$esCoordinador) {
                $especialidades = $especialidadesProfesional;
            }
            // Carga los usuarios relacionados
            $usuarios = User::where('idUsuario', $user->idUsuario)->get();

        }

        // Carga las notificaciones de las inversiones por finalizar
        $notificaciones = [];
        foreach ($inversiones as $inversion) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversion->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 168) {
                $notificaciones[] = $inversion;
            }
        }

        return view('especialidad.index', compact('especialidades', 'inversiones', 'notificaciones'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombreEspecialidad' => 'required|string|max:255',
            'porcentajeAvanceEspecialidad' => 'required|numeric',
            'idInversion' => 'required|exists:inversion,idInversion',
            'idUsuario' => 'array',
            'idUsuario.*' => 'exists:users,idUsuario',
        ], [
            'nombreEspecialidad.required' => 'El campo Nombre Segmento es obligatorio.',
            'porcentajeAvanceEspecialidad.required' => 'El campo Porcentaje Avance Especialidad es obligatorio.',
            'idInversion.required' => 'El campo Inversión es obligatorio.',
            'idInversion.exists' => 'La inversión seleccionada no existe.',
            'idUsuario.required' => 'El campo Usuarios es obligatorio.',
            'idUsuario.*.exists' => 'Uno o más usuarios seleccionados no existen.',
            'idUsuario.*.distinct' => 'Un usuario no puede ser agregado más de una vez a la misma especialidad.',
        ]);

        // Verificar la suma de los porcentajes en la inversión
        $porcentaje = $request->porcentajeAvanceEspecialidad;
        $totalPorcentaje = Especialidad::where('idInversion', $request->idInversion)
            ->sum('porcentajeAvanceEspecialidad');
        if ($totalPorcentaje + $porcentaje > 100) {
            return redirect()->back()->with('errorPorcentaje', 'La suma de los porcentajes de las especialidades no puede superar 100. Por favor, ingrese un valor menor.')->withInput();
        }
        $usuariosUnicos = array_unique($request->idUsuario);

        // Verificar si hay usuarios duplicados
        if (count($usuariosUnicos) != count($request->idUsuario)) {
            return redirect()->back()->with('errorusuario', 'No se puede agregar el mismo usuario más de una vez.')->withInput();
        }

        // Crear un registro
        $especialidad = Especialidad::create([
            'nombreEspecialidad' => $request->nombreEspecialidad,
            'porcentajeAvanceEspecialidad' => $request->porcentajeAvanceEspecialidad,
            'avanceTotalEspecialidad' => 0,
            'idInversion' => $request->idInversion,
        ]);

        // Asignar usuarios a la especialidad
        $especialidad->usuarios()->attach($usuariosUnicos);

        return redirect()->route('especialidad.index')->with('message', 'Especialidad <strong>' . $request->nombreEspecialidad . '</strong> creada correctamente.');
    }

    public function edit($id)
    {
        $especialidad = Especialidad::findOrFail($id);
        $inversiones = Inversion::all();
        $usuarios = User::all();

        return view('especialidad.edit', compact('especialidad', 'inversiones', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreEspecialidad' => 'required|string|max:255',
            'porcentajeAvanceEspecialidad' => 'required|numeric',
            'idUsuario' => 'array|required',
            'idUsuario.*' => 'exists:users,idUsuario',
        ], [
            'nombreEspecialidad.required' => 'El campo Nombre Segmento es obligatorio.',
            'porcentajeAvanceEspecialidad.required' => 'El campo Porcentaje Avance Especialidad es obligatorio.',
            'idUsuario.required' => 'El campo Usuarios es obligatorio.',
            'idUsuario.*.exists' => 'Uno o más usuarios seleccionados no existen.',
            'idUsuario.*.distinct' => 'Un usuario no puede ser agregado más de una vez a la misma especialidad.',
        ]);

        // Encontrar la especialidad existente
        $especialidad = Especialidad::findOrFail($id);

        // Obtener el porcentaje de avance de la especialidad actual
        $nuevoPorcentaje = $request->porcentajeAvanceEspecialidad;
        $porcentajeAnterior = $especialidad->porcentajeAvanceEspecialidad;

        // Verificar la suma de los porcentajes en la inversión
        $totalPorcentaje = Especialidad::where('idInversion', $request->idInversion)
            ->sum('porcentajeAvanceEspecialidad');
        if ($totalPorcentaje + $nuevoPorcentaje - $porcentajeAnterior > 100) {
            return redirect()->route('especialidad.index')->with('errorPorcentaje', 'La suma de los porcentajes de las especialidades no puede superar 100. Por favor, ingrese un valor menor.')->withInput();
        }
        // Eliminar duplicados en el array de usuarios
        $usuariosUnicos = array_unique($request->idUsuario);

        // Verificar si hay usuarios duplicados
        if (count($usuariosUnicos) != count($request->idUsuario)) {
            return redirect()->back()->with('errorusuario', 'No se puede agregar el mismo usuario más de una vez.')->withInput();
        }
        // Actualizar los atributos de la especialidad
        $especialidad->update([
            'nombreEspecialidad' => $request->nombreEspecialidad,
            'porcentajeAvanceEspecialidad' => $request->porcentajeAvanceEspecialidad,
            'avanceTotalEspecialidad' => 0,
        ]);

        // Sincronizar los usuarios asociados
        $especialidad->usuarios()->sync($usuariosUnicos);

        return redirect()->route('especialidad.index')->with('message', 'Especialidad <strong>' . $request->nombreEspecialidad . '</strong> actualizada correctamente.');
    }

    public function destroy($id)
    {
        $especialidad = Especialidad::findOrFail($id);
        $especialidad->delete();

        return redirect()->route('especialidad.index')->with('message', 'Especialidad <strong>' . $especialidad->nombreEspecialidad . '</strong> eliminada correctamente.');
    }

    public function show($id)
    {
        $especialidad = Especialidad::findOrFail($id);

        return view('especialidad.show', compact("especialidad"));
    }

    public function avance($id)
    {
        $especialidad = Especialidad::findOrFail($id);
        $logs = AvanceEspecialidadLog::where('idEspecialidad', $id)->get();

        return view('especialidad.avance', compact('especialidad', 'logs'));
    }

    // Funcion para calcular el avance total de especialidad
    private function calcularAvanceTotalEspecialidad()
    {
        // Buscamos la especialidad
        $especialidades = Especialidad::all();

        // Iteramos las especialidades para realizar los cálculos
        foreach ($especialidades as $especialidad) {
            $fases = Fase::where('idEspecialidad', $especialidad->idEspecialidad)->get();
            $sumEspecialidad = ($especialidad->porcentajeAvanceEspecialidad * $fases->sum('avanceTotalFase')) / 100;

            if ($especialidad->avanceTotalEspecialidad != $sumEspecialidad) {
                AvanceEspecialidadLog::create([
                    'avanceEspecialidadValor' => $sumEspecialidad,
                    'fechaCambioAvanceEspecialidad' => Carbon::now()->subHours(5),
                    'idEspecialidad' => $especialidad->idEspecialidad,
                ]);
            }
            $especialidad->avanceTotalEspecialidad = $sumEspecialidad;
            $especialidad->save();
        }
    }

    // Función para calcular el % de avance de la inversión
    private function calcularAvanceTotalInversión()
    {
        $inversiones = Inversion::all();

        foreach ($inversiones as $inversion) {
            $especialidades = Especialidad::where('idInversion', $inversion->idInversion)->get();
            $sumAvanceTotalInversion = $especialidades->sum('avanceTotalEspecialidad');

            // Obtener último log
            $ultimoLog = AvanceInversionLog::where('idInversion', $inversion->idInversion)
                ->latest('fechaCambioAvanceInversion')
                ->first();

            $deberiaRegistrar = false;

            if (!$ultimoLog) {
                $deberiaRegistrar = true;
            } else {
                $diasDiferencia = Carbon::parse($ultimoLog->fechaCambioAvanceInversion)->diffInDays(now());
                if (
                    $diasDiferencia > 6 ||
                    $sumAvanceTotalInversion == 100
                ) {
                    $deberiaRegistrar = true;
                }
            }

            if ($deberiaRegistrar) {
                AvanceInversionLog::create([
                    'avanceInversionValor' => $sumAvanceTotalInversion,
                    'fechaCambioAvanceInversion' => Carbon::now()->subHours(5),
                    'idInversion' => $inversion->idInversion,
                ]);
            }

            $inversion->avanceInversion = $sumAvanceTotalInversion;
            $inversion->save();
        }
    }

    public function pdf(Request $request)
    {
        date_default_timezone_set('America/Lima');
        // Obtener el usuario autenticado
        $usuario = auth()->user();

         // Obtener la inversión solicitada
        $inversion = Inversion::with('coordinadores')->findOrFail($request->idInversion);

        // Verifica si el usuario puede acceder (admin, responsable o coordinador)
        $esResponsable = $inversion->idUsuario == $usuario->idUsuario;
        $esCoordinador = $inversion->coordinadores->contains('idUsuario', $usuario->idUsuario);

        if ($usuario->isAdmin || $esResponsable || $esCoordinador) {
            $especialidades = Especialidad::where('idInversion', $inversion->idInversion)->get();

            $pdf = Pdf::loadView('especialidad.pdf', [
                'inversiones' => collect([$inversion]),
                'especialidades' => $especialidades,
            ]);

            return $pdf->stream();
        }

        abort(403, 'No tienes permiso para ver esta inversión.');
    }

    public function getUsuariosPorInversion($idInversion)
    {
        // Obtener los IDs de los usuarios asignados a la inversión
        $jefes = AsignacionProfesional::where('idInversion', $idInversion)->pluck('idUsuario');

        // Obtener los usuarios con sus profesiones y especialidades
        $usuarios = User::with(['profesiones', 'especialidades'])
            ->whereIn('idUsuario', $jefes)
            ->get();

        // Devolver la información de los usuarios en formato JSON
        return response()->json($usuarios);
    }
}
