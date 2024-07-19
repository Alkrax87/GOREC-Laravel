<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inversion;
use App\Models\Complementario;
class ComplementarioController extends Controller
{
    // Función de carga de datos
    public function index(Request $request){
        // Carga de datos de datos
        $complementarios = Complementario::with(['inversion'])->get();
        $inversiones = Inversion::all();

        return view('complementario.index', compact('complementarios', 'inversiones'));
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

        // Creamos un registro
        Complementario::create($request->all());

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