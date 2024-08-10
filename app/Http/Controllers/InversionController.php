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
use Carbon\Carbon;
use Auth;

class InversionController extends Controller
{
    // Función de carga de datos
    public function index(Request $request){
        // Carga de datos de provincias y distritos mediante un JSON
        $this->sumaTotalAvance();
        $json = File::get(public_path('json/cusco.json'));
        $data = json_decode($json, true);
        $provincias = $data['provincias'];

        // Cargamos los datos de inversion filtrador en base al usuario logeado
        $user = Auth::user();
        if ($user->isAdmin) {
            $inversiones = Inversion::all();
            $usuarios = User::whereNotNull('email')->where('idUsuario', '!=', 1)->get();
        } else {
            $inversiones = Inversion::where('idUsuario', $user->idUsuario)->get();
            $usuarios = User::where('idUsuario', $user->idUsuario)->get();
        }
        // Cargamos logs
        $logs = EstadoLog::all();

        return view('inversion.index', compact('inversiones', 'provincias', 'usuarios', 'logs'));
    }

    // Función que devuelve el formulario de crear
    public function create(){
        return view('inversion.create');
    }

    // Función de agreagar un registro
    public function store(Request $request){
        // Validaciones
        $request->validate([
            'cuiInversion' => 'required|string|max:255',
            'nombreInversion' => 'required|string|max:1024',
            'nombreCortoInversion' => 'required|string|max:255',
            'idUsuario' => 'required|exists:users,idUsuario',
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

        // Creamos un registro
        Inversion::create($request->all());

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
            'cuiInversion' => 'required|string|max:255',
            'nombreInversion' => 'required|string|max:1024',
            'nombreCortoInversion' => 'required|string|max:255',
            'idUsuario' => 'required|exists:users,idUsuario',
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
            'nombreInversion.required' => 'El campo Nombre de Inversión es obligatorio.',
            'nombreCortoInversion.required' => 'El campo Nombre Corto es obligatorio.',
            'idUsuario.required' => 'El Usuario es obligatorio.',
            'idUsuario.exists' => 'El usuario seleccionado no existe en la tabla de usuarios.',
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
            'fechaFinalInversion.after_or_equal' => 'La fecha final debe ser igual o posterior a la fecha inicio.',
            'presupuestoFormulacionInversion.required' => 'El campo Presupuesto de Formulación es obligatorio.',
            'presupuestoFormulacionInversion.numeric' => 'El campo Presupuesto de Formulación debe ser un número.',
            'presupuestoFormulacionInversion.between' => 'El campo Presupuesto de Formulacióndebe estar entre 0 y 999999999999999999999.99.',
            'presupuestoEjecucionInversion.required' => 'El campo Presupuesto de Ejecución es obligatorio.',
            'presupuestoEjecucionInversion.numeric' => 'El campo Presupuesto de Ejecución debe ser un número.',
            'presupuestoEjecucionInversion.between' => 'El campo Presupuesto de Ejecución debe estar entre 0 y 999999999999999999999.99.',
        ]);

        // Buscamos la inversión
        $inversion = Inversion::findOrFail($id);

        // Guardamos el estado actual
        $CurrentEstadoInversion = $inversion->estadoInversion;

        // Editamos la inversión
        $inversion->update($request->all());

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

    // Función para calcular el % de avance de la inversión
    private function sumaTotalAvance() {
        // Carga de datos de inversiones
        $inversiones = Inversion::all();

        // Sumamos los avances en base a sus especialidades de cada inversión
        foreach ($inversiones as $inversion) {
            $especialidades = Especialidad::where('idInversion', $inversion->idInversion)->get();
            $sumAvanceTotalEspecialidad = $especialidades->sum('avanceTotalEspecialidad');
            $inversion->avanceInversion = $sumAvanceTotalEspecialidad;
            $inversion->save();
        }
    }
    public function pdf($id) {
        date_default_timezone_set('America/Lima');
        $inversion = Inversion::with([
            'usuario.profesiones', 
            'usuario.especialidades',
            'profesional.usuario.profesiones',
            'asistente.usuario',
            'asistente.jefe'])->findOrFail($id);
            $data = [
                'title' => 'Welcome to ItSolutionStuff.com',
                'date' =>  date('d/m/Y') . str_repeat('&nbsp;', 20) . date('H:i:s') 
            
            ];
    
        $pdf = Pdf::loadView('inversion.pdf', compact('inversion'));
        return $pdf->stream();
    }
    
    
    public function pdfs(){
        $inversiones = Inversion::all();
        $usuarios = User::all(); // Carga todas las inversiones
        $pdfs = Pdf::loadView('inversion.pdfs', compact('inversiones', 'usuarios'));
        return $pdfs->stream();
        //return view('especialidad.pdf', compact('especialidades', 'inversiones', 'usuarios', 'fases', 'subfases'));
    }
}