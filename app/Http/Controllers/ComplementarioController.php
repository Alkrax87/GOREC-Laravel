<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inversion;
use App\Models\Complementario;
use Carbon\Carbon;
use Auth;

class ComplementarioController extends Controller
{
    // Función de carga de datos
    public function index(Request $request){
        // Cargamos los datos de inversion filtrador en base al usuario logeado
        $user = Auth::user();
        if ($user->isAdmin) {
            // Si el usuario es administrador, carga todas las inversiones
            $inversiones = Inversion::all();
            $complementarios = Complementario::all();
        } else {
            // Si no es administrador, carga las inversiones propias y aquellas en las que ha sido asignado como profesional
            $inversionesPropias = Inversion::where('idUsuario', $user->idUsuario)->get();

            // Obtén las inversiones donde el usuario ha sido asignado como profesional
            $inversionesAsignadas = Inversion::whereHas('profesional', function ($query) use ($user) {
                $query->where('idUsuario', $user->idUsuario);
            })->get();

            // Combina las inversiones propias y las asignadas
            $inversiones = $inversionesPropias->merge($inversionesAsignadas)->unique('idInversion');

            $inversionIds = $inversiones->pluck('idInversion');
            $complementarios = Complementario::whereIn('idInversion', $inversionIds)->get();
        }

        $notificaciones = [];
        foreach ($inversiones as $inversion) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversion->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 168) {
                $notificaciones[] = $inversion;
            }
        }

        return view('complementario.index', compact('complementarios', 'inversiones','notificaciones'));
    }

    // Función que devuelve el formulario de crear
    public function create(){
        return view('complementario.create');
    }

    // Función de agreagar un registro
    public function store(Request $request){
        // Validaciones
        $request->validate([
            'nombreEstudiosComplementarios' => 'required|string|max:255',
            'observacionEstudiosComplementarios' => 'required|string|max:255',
            'fechaInicioEstudiosComplementarios' => 'required|date',
            'fechaFinalEstudiosComplementarios' => 'required|date|after_or_equal:fechaInicioEstudiosComplementarios',
            'estadoEstudiosComplementarios' => 'required|string|max:255',
            'idInversion' => 'required|exists:inversion,idInversion',
        ],[
            'nombreEstudiosComplementarios.required' => 'El nombre es obligatorio.',
            'observacionEstudiosComplementarios.required' => 'La obervación es obligatoria.',
            'fechaInicioEstudiosComplementarios.required' => 'La fecha inicio es obligatoria.',
            'fechaInicioEstudiosComplementarios.date' => 'La fecha inicio debe ser una fecha válida.',
            'fechaFinalEstudiosComplementarios.required' => 'La fecha final es obligatoria.',
            'fechaFinalEstudiosComplementarios.date' => 'La fecha final debe ser una fecha válida.',
            'fechaFinalEstudiosComplementarios.after_or_equal' => 'La fecha final debe ser igual o posterior a la Fecha Inicio.',
            'estadoEstudiosComplementarios.required' => 'El estado es obligatorio.',
            'idInversion.required' => 'La inversión es obligatoria.',
            'idInversion.exists' => 'La inversión seleccionada no existe.',
        ]);

       // Verificar si el usuario está autenticado
    if (!Auth::check()) {
        return redirect()->route('complementario.index')->withErrors('Debe estar autenticado para realizar esta acción.');
    }

    // Agregar el ID del usuario autenticado al arreglo de datos
    $data = $request->all();
    $data['idUsuario'] = Auth::user()->idUsuario;  // Asigna el ID del usuario autenticado

    // Crear el registro
    Complementario::create($data);
        return redirect()->route('complementario.index')->with('message','Elemento creado correctamente.');
    }

    // Función cargar un elemento en editar
    public function edit($id){
        //Cargamos los datos de complementario
        $complementarios = Complementario::findOrFail($id);

        return view('complementario.edit', compact('complementarios'));
    }

    public function update(Request $request, $id){
        // Validaciones
        $request->validate([
            'nombreEstudiosComplementarios' => 'required|string|max:255',
            'observacionEstudiosComplementarios' => 'required|string|max:255',
            'fechaInicioEstudiosComplementarios' => 'required|date',
            'fechaFinalEstudiosComplementarios' => 'required|date|after_or_equal:fechaInicioEstudiosComplementarios',
            'estadoEstudiosComplementarios' => 'required|string|max:255',
            'idInversion' => 'required|exists:inversion,idInversion',
        ],[
            'nombreEstudiosComplementarios.required' => 'El nombre es obligatorio.',
            'observacionEstudiosComplementarios.required' => 'La obervación es obligatoria.',
            'fechaInicioEstudiosComplementarios.required' => 'La fecha inicio es obligatoria.',
            'fechaInicioEstudiosComplementarios.date' => 'La fecha inicio debe ser una fecha válida.',
            'fechaFinalEstudiosComplementarios.required' => 'La fecha final es obligatoria.',
            'fechaFinalEstudiosComplementarios.date' => 'La fecha final debe ser una fecha válida.',
            'fechaFinalEstudiosComplementarios.after_or_equal' => 'La fecha final debe ser igual o posterior a la Fecha Inicio.',
            'estadoEstudiosComplementarios.required' => 'El estado es obligatorio.',
            'idInversion.required' => 'La inversión es obligatoria.',
            'idInversion.exists' => 'La inversión seleccionada no existe.',
        ]);

        // Buscamos el complementario
        $complementarios = Complementario::findOrFail($id);

        // Editamos el complementario
        $complementarios->update($request->all());

        return redirect()->route('complementario.index')->with('message', 'Elemento actualizado correctamente.');
    }

    // Función eliminar un registro
    public function destroy($id){
        // Buscamos el complementario
        $complementarios = Complementario::findOrFail($id);

        // Eliminamos el complementario
        $complementarios->delete();

        return redirect()->route('complementario.index')->with('message','Elemento eliminado correctamente.');
    }

    // Función mostrar un registro
    public function show($id){
        // Buscamos el complementario
        $complementarios = Complementario::findOrFail($id);

        return view('complementario.show', compact('complementarios'));
    }
}