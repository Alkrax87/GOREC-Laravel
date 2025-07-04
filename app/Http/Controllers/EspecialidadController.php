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
            $inversiones = Inversion::all();
            $especialidades = Especialidad::all();
        } else {
            $inversiones = Inversion::where('idUsuario', $user->idUsuario)->get();
            $inversionIds = $inversiones->pluck('idInversion');
            $especialidades = Especialidad::whereIn('idInversion', $inversionIds)->get();
            $especialidadIds = $especialidades->pluck('idEspecialidad');
            $especialidadesAdicionales = Especialidad::whereHas('usuarios', function ($query) use ($user) {
                $query->where('especialidad_users.idUsuario', $user->idUsuario);
            })->whereNotIn('idEspecialidad', $especialidadIds)->get();
            $especialidades = $especialidades->merge($especialidadesAdicionales);
        }

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

        if ($usuario->isAdmin) {
            // Obtener todas las inversiones si es admin y selecciona alguna en el formulario
            $inversiones = Inversion::where('idInversion', $request->idInversion)->get();
        } else {
            // Obtener solo las inversiones del usuario autenticado
            $inversiones = Inversion::where('idUsuario', $usuario->idUsuario)
                ->where('idInversion', $request->idInversion)
                ->get();
        }
        // Obtener las especialidades relacionadas a esas inversiones
        $especialidades = Especialidad::whereIn('idInversion', $inversiones->pluck('idInversion'))->get();
        // Generar el PDF
        $pdf = Pdf::loadView('especialidad.pdf', compact('inversiones', 'especialidades'));
        return $pdf->stream();
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
