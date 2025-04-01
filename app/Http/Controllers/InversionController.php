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
use Carbon\Carbon;
use Auth;

class InversionController extends Controller
{
    // Función de carga de datos
    public function index(Request $request){
        // Carga de datos de provincias y distritos mediante un JSON
        $json = File::get(public_path('json/cusco.json'));
        $data = json_decode($json, true);
        $provincias = $data['provincias'];
        $profesionales = AsignacionProfesional::all();

        // Cargamos los datos de inversion filtrador en base al usuario logeado
        $user = Auth::user();
        if ($user->isAdmin) {
            // Si el usuario es administrador, carga todas las inversiones
            $inversiones = Inversion::all();
            $usuarios = User::whereNotNull('email')->where('idUsuario', '!=', 1)->get();
        } else {
            // Si no es administrador, carga las inversiones propias y aquellas en las que ha sido asignado como profesional
            $inversionesPropias = Inversion::where('idUsuario', $user->idUsuario)->get();

            // Obtén las inversiones donde el usuario ha sido asignado como profesional
            $inversionesAsignadas = Inversion::whereHas('profesional', function ($query) use ($user) {
                $query->where('idUsuario', $user->idUsuario);
            })->get();

            // Combina las inversiones propias y las asignadas
            $inversiones = $inversionesPropias->merge($inversionesAsignadas)->unique('idInversion');

            // Carga los usuarios relacionados
            $usuarios = User::where('idUsuario', $user->idUsuario)->get();
        }
        // Cargamos logs
        $logs = EstadoLog::all();

        $avanceInversionLog = AvanceInversionLog::all();

        $notificaciones = [];
        foreach ($inversiones as $inversion) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversion->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 168) {
                $notificaciones[] = $inversion;
            }
        }

        return view('inversion.index', compact('inversiones', 'provincias', 'avanceInversionLog', 'usuarios', 'logs', 'notificaciones'));
    }

    // Función de agregar un registro
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
            'fechaFinalInversion' => 'required|date',
            'presupuestoFormulacionInversion' => 'required|numeric|between:0,999999999999999999999.99',
            'presupuestoEjecucionInversion' => 'required|numeric|between:0,999999999999999999999.99',
        ], [
            'cuiInversion.required' => 'El campo CUI Inversión es obligatorio.',
            'nombreInversion.required' => 'El campo Nombre de Inversión es obligatorio.',
            'nombreCortoInversion.required' => 'El campo Nombre Corto es obligatorio.',
            'idUsuario.required' => 'El Usuario es obligatorio.',
            'idUsuario.exists' => 'El usuario seleccionado no existe en la tabla de usuarios.',
            'idCoordinador.required' => 'El campo Coordinador es obligatorio.',
            'idCoordinador.*.exists' => 'Uno o más usuarios seleccionados no existen.',
            'idCoordinador.*.distinct' => 'Un usuario no puede ser agregado más de una vez a la misma inversión.',
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
            'presupuestoFormulacionInversion.required' => 'El campo Presupuesto de Formulación es obligatorio.',
            'presupuestoFormulacionInversion.numeric' => 'El campo Presupuesto de Formulación debe ser un número.',
            'presupuestoFormulacionInversion.between' => 'El campo Presupuesto de Formulacióndebe estar entre 0 y 999999999999999999999.99.',
            'presupuestoEjecucionInversion.required' => 'El campo Presupuesto de Ejecución es obligatorio.',
            'presupuestoEjecucionInversion.numeric' => 'El campo Presupuesto de Ejecución debe ser un número.',
            'presupuestoEjecucionInversion.between' => 'El campo Presupuesto de Ejecución debe estar entre 0 y 999999999999999999999.99.',
        ]);

        $dataCoordinador = $request->get('idCoordinador', []);
        $data = $request->except('idCoordinador');
        // $data['idCoordinador'] = 1;
        // ======== ELIMINAR idCordinador DE TABLA INVERSIÓN ========
        // ALTER TABLE inversion DROP FOREIGN KEY inversion_idCordinador_foreign;
        // ALTER TABLE inversion DROP COLUMN idCordinador;

        // Manejar la subida del archivo
        if ($request->hasFile('archivoInversion')) {
            $file = $request->file('archivoInversion');
            $data['archivoInversion'] = file_get_contents($file->getRealPath());
        }

        // Creamos un registro
        $inversion = Inversion::create($data);

        if (!empty($dataCoordinador)) {
            $inversion->coordinadores()->sync($dataCoordinador);
        }

        return redirect()->route('inversion.index')->with('message','Inversión ' . $request->nombreCortoInversion . ' creada exitosamente.');
    }

    // Función cargar un elemento en editar
    public function edit($id){
        // Carga de datos de provincias y distritos mediante un JSON
        $json = File::get(public_path('json/cusco.json'));
        $data = json_decode($json, true);
        $provincias = $data['provincias'];

        // Cargamos los datos de inversion
        $inversiones = Inversion::all();

        return view('inversion.edit', compact('inversiones', 'provincias'));
    }

    // Función editar un registro
    public function update(Request $request, $id){
        // Validaciones
        $request->validate([
            'estadoInversion' => 'required|string|max:255',
        ], [
            'estadoInversion.required' => 'El campo Estado es obligatorio.',
        ]);

        // Buscamos la inversión
        $inversion = Inversion::findOrFail($id);

        // Guardamos el estado actual
        $CurrentEstadoInversion = $inversion->estadoInversion;

        $data = $request->except(['archivoInversion', 'deleteFile']);

        // Manejar la subida del archivo
        if ($request->hasFile('archivoInversion')) {
            $file = $request->file('archivoInversion');
            $data['archivoInversion'] = file_get_contents($file->getRealPath());
        }

        // Verificar si se ha solicitado eliminar el archivo
        if ($request->has('deleteFile') && $request->input('deleteFile') == '1') {
            // Borramos el archivo
            $data['archivoInversion'] = null;
        }

        // Editamos la inversión
        $inversion->update($data);

         // Comprobamos si el estado ha cambiado
        if ($request->estadoInversion != $CurrentEstadoInversion) {
            EstadoLog::create([
                'estadoInversionOLD' => $CurrentEstadoInversion,
                'estadoInversionNEW' => $request->estadoInversion,
                'fechaCambioEstado' => Carbon::now()->subHours(5),
                'idInversion' => $id,
            ]);
        }

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

        return view('inversion.show', compact('inversion'));
    }

    // Función para descargar el PDF (Opcional)
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

    
    public function pdf($id) {
        date_default_timezone_set('America/Lima');
        $inversion = Inversion::findOrFail($id);
        $pdf = Pdf::loadView('inversion.pdf', compact('inversion'));
        $pdf->setPaper('A4', 'portrait');
         // Establecer opciones adicionales
        
        return $pdf->stream();
    }


    public function pdfs(){
        date_default_timezone_set('America/Lima');
        $inversiones = Inversion::all(); // Carga todas las inversiones
        $pdfs = Pdf::loadView('inversion.pdfs', compact('inversiones'));
        return $pdfs->stream();
        //return view('especialidad.pdf', compact('especialidades', 'inversiones', 'usuarios', 'fases', 'subfases'));
    }
}