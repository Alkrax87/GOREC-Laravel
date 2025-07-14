<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Inversion;
use App\Models\Especialidad;
use App\Models\User;
use App\Models\Especialidades;
use App\Models\AsignacionProfesional;
use App\Models\AsignacionAsistente;
use App\Models\EstadoLog;
use App\Models\AvanceInversionLog;
use App\Models\ComentarioInversion;
use Carbon\Carbon;
use Auth;

class InversionController extends Controller
{
    // Función carga de datos
    public function index(Request $request){
        // Carga de datos de provincias y distritos mediante un JSON
        $json = File::get(public_path('json/cusco.json'));
        $data = json_decode($json, true);
        $provincias = $data['provincias'];

        // Cargamos los datos de inversion filtrador en base al usuario logeado
        $user = Auth::user();
        if ($user->isAdmin) {
            /*
                Si el usuario es administrador, carga todas las inversiones
            */
            $inversiones = Inversion::all();
            $usuarios = User::whereNotNull('email')->where('idUsuario', '!=', 1)->get();
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

        return view('inversion.index', compact('inversiones', 'provincias', 'usuarios','notificaciones'));
    }

    // Función agregar un registro
    public function store(Request $request){
        // Validaciones
        $request->validate([
            'cuiInversion' => 'required|string|max:255',
            'nombreInversion' => 'required|string|max:1024',
            'nombreCortoInversion' => 'required|string|max:255',
            'idUsuario' => 'required|exists:users,idUsuario',
            'idCoordinador' => 'required|array',
            'idCoordinador.*' => 'exists:users,idUsuario',
            'provinciaInversion' => 'required|string|max:255',
            'distritoInversion' => 'required|string|max:255',
            'nivelInversion' => 'required|string|max:255',
            'funcionInversion' => 'required|string|max:255',
            'modalidadInversion' => 'required|string|max:255',
            'estadoInversion' => 'required|string|max:255',
            'fechaInicioInversion' => 'required|date',
            'fechaFinalInversion' => 'required|date|after_or_equal:fechaInicioInversion',
            'presupuestoFormulacionInversion' => 'required|numeric|between:0,999999999999999999999.99',
            'presupuestoEjecucionInversion' => 'required|numeric|between:0,999999999999999999999.99',
        ], [
            'cuiInversion.required' => 'El campo CUI Inversión es obligatorio.',
            'nombreInversion.required' => 'El campo Nombre es obligatorio.',
            'nombreCortoInversion.required' => 'El campo Nombre Corto es obligatorio.',
            'idUsuario.required' => 'El campo Responsable es obligatorio.',
            'idUsuario.exists' => 'El usuario seleccionado no existe en la tabla de usuarios.',
            'idCoordinador.required' => 'El campo Coordinador es obligatorio.',
            'idCoordinador.*.exists' => 'Uno o más usuarios seleccionados no existen.',
            'provinciaInversion.required' => 'El campo Provincia es obligatorio.',
            'distritoInversion.required' => 'El campo Distrito es obligatorio.',
            'nivelInversion.required' => 'El campo Nivel es obligatorio.',
            'funcionInversion.required' => 'El campo Función es obligatorio.',
            'modalidadInversion.required' => 'El campo Modalidad es obligatorio.',
            'estadoInversion.required' => 'El campo Estado es obligatorio.',
            'fechaInicioInversion.required' => 'El campo Fecha Inicio es obligatorio.',
            'fechaInicioInversion.date' => 'El campo Fecha Inicio debe ser una fecha válida.',
            'fechaFinalInversion.required' => 'El campo Fecha Final es obligatorio.',
            'fechaFinalInversion.date' => 'El campo Fecha Final debe ser una fecha válida.',
            'fechaFinalInversion.after_or_equal' => 'El campo fecha final debe ser una fecha posterior a la fecha inicial.',
            'presupuestoFormulacionInversion.required' => 'El campo Presupuesto de Formulación es obligatorio.',
            'presupuestoFormulacionInversion.numeric' => 'El campo Presupuesto de Formulación debe ser un número.',
            'presupuestoFormulacionInversion.between' => 'El campo Presupuesto de Formulación debe estar entre 0 y 999999999999999999999.99.',
            'presupuestoEjecucionInversion.required' => 'El campo Presupuesto de Ejecución es obligatorio.',
            'presupuestoEjecucionInversion.numeric' => 'El campo Presupuesto de Ejecución debe ser un número.',
            'presupuestoEjecucionInversion.between' => 'El campo Presupuesto de Ejecución debe estar entre 0 y 999999999999999999999.99.',
        ]);

        // Obtenemos el array que contiene los id de los coordinadores
        $dataCoordinador = $request->get('idCoordinador', []);

        // Obtenemos el resto de datos del request
        $data = $request->except('idCoordinador');

        // ======== ELIMINAR idCordinador DE TABLA INVERSIÓN ========
        // ALTER TABLE inversion DROP FOREIGN KEY inversion_idCordinador_foreign;
        // ALTER TABLE inversion DROP COLUMN idCordinador;

        // Manejar la subida del archivo
        if ($request->hasFile('archivoInversion')) {
            $file = $request->file('archivoInversion');
            $data['archivoInversion'] = file_get_contents($file->getRealPath());
        }

        // Hacer un registro
        $inversion = Inversion::create($data);

        // Agregamos los coordinadores a la tabla pivote "inversion_coordinador"
        $inversion->coordinadores()->sync($dataCoordinador);

        return redirect()->route('inversion.index')->with('message','Inversión ' . $request->nombreCortoInversion . ' creada exitosamente.');
    }

    // Función cargar un elemento en editar
    public function edit($id){
        // Carga de datos de provincias y distritos mediante un JSON
        $json = File::get(public_path('json/cusco.json'));
        $data = json_decode($json, true);
        $provincias = $data['provincias'];

        // Cargamos los datos de la inversion
        $inversion = Inversion::findOrFail($id);
        $usuarios = User::whereNotNull('email')->where('idUsuario', '!=', 1)->get();

        // Cargamos los datos de inversion filtrador en base al usuario logeado
        $user = Auth::user();
        if ($user->isAdmin) {
            /*
                Si el usuario es administrador, carga todas las inversiones
            */
            $inversiones = Inversion::all();
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
        }

        // Carga las notificaciones de las inversiones por finalizar
        $notificaciones = [];
        foreach ($inversiones as $inversions) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversions->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 168) {
                $notificaciones[] = $inversions;
            }
        }

        return view('inversion.edit', compact('inversion', 'usuarios', 'provincias', 'notificaciones'));
    }

    // Función editar un registro
    public function update(Request $request, $id){
        // Validaciones
        $request->validate([
            'cuiInversion' => 'required|string|max:255',
            'nombreInversion' => 'required|string|max:1024',
            'nombreCortoInversion' => 'required|string|max:255',
            'idUsuario' => 'required|exists:users,idUsuario',
            'idCoordinador' => 'required|array',
            'idCoordinador.*' => 'exists:users,idUsuario',
            'provinciaInversion' => 'required|string|max:255',
            'distritoInversion' => 'required|string|max:255',
            'nivelInversion' => 'required|string|max:255',
            'funcionInversion' => 'required|string|max:255',
            'modalidadInversion' => 'required|string|max:255',
            'estadoInversion' => 'required|string|max:255',
            'fechaInicioInversion' => 'required|date',
            'fechaFinalInversion' => 'required|date|after_or_equal:fechaInicioInversion',
            'presupuestoFormulacionInversion' => 'required|numeric|between:0,999999999999999999999.99',
            'presupuestoEjecucionInversion' => 'required|numeric|between:0,999999999999999999999.99',
        ], [
            'cuiInversion.required' => 'El campo CUI Inversión es obligatorio.',
            'nombreInversion.required' => 'El campo Nombre es obligatorio.',
            'nombreCortoInversion.required' => 'El campo Nombre Corto es obligatorio.',
            'idUsuario.required' => 'El campo Responsable es obligatorio.',
            'idUsuario.exists' => 'El usuario seleccionado no existe en la tabla de usuarios.',
            'idCoordinador.required' => 'El campo Coordinador es obligatorio.',
            'idCoordinador.*.exists' => 'Uno o más usuarios seleccionados no existen.',
            'provinciaInversion.required' => 'El campo Provincia es obligatorio.',
            'distritoInversion.required' => 'El campo Distrito es obligatorio.',
            'nivelInversion.required' => 'El campo Nivel es obligatorio.',
            'funcionInversion.required' => 'El campo Función es obligatorio.',
            'modalidadInversion.required' => 'El campo Modalidad es obligatorio.',
            'estadoInversion.required' => 'El campo Estado es obligatorio.',
            'fechaInicioInversion.required' => 'El campo Fecha Inicio es obligatorio.',
            'fechaInicioInversion.date' => 'El campo Fecha Inicio debe ser una fecha válida.',
            'fechaFinalInversion.required' => 'El campo Fecha Final es obligatorio.',
            'fechaFinalInversion.date' => 'El campo Fecha Final debe ser una fecha válida.',
            'fechaFinalInversion.after_or_equal' => 'El campo fecha final debe ser una fecha posterior a la fecha inicial.',
            'presupuestoFormulacionInversion.required' => 'El campo Presupuesto de Formulación es obligatorio.',
            'presupuestoFormulacionInversion.numeric' => 'El campo Presupuesto de Formulación debe ser un número.',
            'presupuestoFormulacionInversion.between' => 'El campo Presupuesto de Formulación debe estar entre 0 y 999999999999999999999.99.',
            'presupuestoEjecucionInversion.required' => 'El campo Presupuesto de Ejecución es obligatorio.',
            'presupuestoEjecucionInversion.numeric' => 'El campo Presupuesto de Ejecución debe ser un número.',
            'presupuestoEjecucionInversion.between' => 'El campo Presupuesto de Ejecución debe estar entre 0 y 999999999999999999999.99.',
        ]);

        // Obtenemos el array que contiene los id de los coordinadores
        $dataCoordinador = $request->get('idCoordinador', []);

        // Buscamos la inversión
        $inversion = Inversion::findOrFail($id);

        // Obtenemos el request sin el archivoInversion
        $data = $request->except(['archivoInversion', 'deleteFile']);

        // Manejar la subida del archivo
        if ($request->hasFile('archivoInversion')) {
            $file = $request->file('archivoInversion');
            $data['archivoInversion'] = file_get_contents($file->getRealPath());
        }

        // Verificar si se ha solicitado eliminar el archivo
        if ($request->has('deleteFile') && $request->input('deleteFile') == '1' && $request->hasFile('archivoInversion')) {
            return back()->withErrors(['archivoInversion' => 'No puedes subir un archivo y eliminarlo al mismo tiempo.']);
        }

        // Guardamos el estado actual
        $CurrentEstadoInversion = $inversion->estadoInversion;

        // Comprobamos si el estado ha cambiado
        if ($request->estadoInversion != $CurrentEstadoInversion) {
            EstadoLog::create([
                'estadoInversionOLD' => $CurrentEstadoInversion,
                'estadoInversionNEW' => $request->estadoInversion,
                'fechaCambioEstado' => Carbon::now()->subHours(5),
                'idInversion' => $id,
            ]);
        }

        // Actualizamos la Inversion
        $inversion->update($data);
        $inversion->coordinadores()->sync($dataCoordinador);

        return redirect()->route('inversion.index')->with('message','Inversión ' . $request->nombreCortoInversion . ' actualizada exitosamente.');
    }

    // Función eliminar un registro
    public function destroy($id){
        // Buscamos la inversión
        $inversion = Inversion::findOrFail($id);

        // Eliminamos la inversión
        $inversion->delete();

        return redirect()->route('inversion.index')->with('message','Inversión ' . $inversion->nombreCortoInversion . ' eliminada exitosamente.');
    }

    // Función mostrar un registro
    public function show($id){
        // Buscamos la inversión
        $inversion = Inversion::findOrFail($id);

        // Cargamos los datos de inversion filtrador en base al usuario logeado
        $user = Auth::user();
        if ($user->isAdmin) {
            /*
                Si el usuario es administrador, carga todas las inversiones
            */
            $inversiones = Inversion::all();
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
        }

        // Carga las notificaciones de las inversiones por finalizar
        $notificaciones = [];
        foreach ($inversiones as $inversions) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversions->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 168) {
                $notificaciones[] = $inversions;
            }
        }

        return view('inversion.show', compact('inversion', 'inversion', 'notificaciones'));
    }

    // Función para descargar el PDF
    public function download($id)
    {
        $inversion = Inversion::findOrFail($id);

        if (!$inversion->archivoInversion) {
            return redirect()->back()->with('error', 'No hay archivo PDF asociado a esta inversión.');
        }

        return response($inversion->archivoInversion)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $inversion->nombreCortoInversion . '.pdf"');
    }

    public function estadoLog($id){

        $inversion = Inversion::findOrFail($id);
        $logs = EstadoLog::where('idInversion', $id)->get();
        $notificaciones = [];

        // Obtener todas las inversiones
        $inversiones = Inversion::all(); // Agregamos esta línea para definir $inversiones

        foreach ($inversiones as $inversions) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversions->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 168) {
                $notificaciones[] = $inversions;
            }
        }
        return view('inversion.estadoLog', compact('inversion', 'logs', 'notificaciones'));
    }

    public function avanceInversionLog($id){
        $inversion = Inversion::findOrFail($id);
        $fullLogs  = AvanceInversionLog::where('idInversion', $id)->orderBy('fechaCambioAvanceInversion')->get();

        $maxPuntos = 30;
        $resumenLogs = collect();

        if ($fullLogs->count() > $maxPuntos) {
            $chunkSize = ceil($fullLogs->count() / $maxPuntos);

            for ($i = 0; $i < $fullLogs->count(); $i += $chunkSize) {
                $grupo = $fullLogs->slice($i, $chunkSize);
                $fecha = $grupo->first()->fechaCambioAvanceInversion;
                $valor = round($grupo->avg('avanceInversionValor'), 2);

                $resumenLogs->push((object)[
                    'fechaCambioAvanceInversion' => $fecha,
                    'avanceInversionValor' => $valor
                ]);
            }

            // Asegurar primero y último reales
            $resumenLogs[0] = $fullLogs->first();
            $resumenLogs[$resumenLogs->count() - 1] = $fullLogs->last();
            $resumenLogs = $resumenLogs->values();
        } else {
            $resumenLogs = $fullLogs;
        }

        // Cargamos los datos de inversion filtrador en base al usuario logeado
        $user = Auth::user();
        if ($user->isAdmin) {
            /*
                Si el usuario es administrador, carga todas las inversiones
            */
            $inversiones = Inversion::all();
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
        }

        // Carga las notificaciones de las inversiones por finalizar
        $notificaciones = [];
        foreach ($inversiones as $inversions) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversions->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 168) {
                $notificaciones[] = $inversions;
            }
        }

        return view('inversion.avanceInversionLog', compact('inversion', 'fullLogs', 'resumenLogs', 'notificaciones'));
    }

    public function pdf($id) {
        date_default_timezone_set('America/Lima');
            // Obtener la inversión
        $inversion = Inversion::findOrFail($id);

        // Obtener los comentarios asociados a esta inversión
        $comentarios = ComentarioInversion::where('idInversion', $id)->get();

        // Generar el PDF pasando también los comentarios a la vista
        $pdf = Pdf::loadView('inversion.pdf', compact('inversion', 'comentarios'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream();
    }

    public function pdfs(){
        date_default_timezone_set('America/Lima');
        $inversiones = Inversion::all();
        $pdfs = Pdf::loadView('inversion.pdfs', compact('inversiones'));
        return $pdfs->stream();
    }
}