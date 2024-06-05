<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inversion;
use App\Models\Complementario;
class ComplementarioController extends Controller
{
    public function index(Request $request){
        $complementarios = Complementario::with(['inversion'])->get();
        $inversiones = Inversion::all(); // Carga todas las inversiones
        return view('complementario.index', compact('complementarios', 'inversiones'));
    }

    public function create(){
        $inversiones = Inversion::all(); // Para cargar todas las inversiones
        
        return view('complementario.create', compact('inversiones'));
    }

    public function store(Request $request){
        $request->validate([
            'nombreEstudiosComplementarios' => 'required|string|max:255',
            'observacionEstudiosComplementarios' => 'required|string|max:255',
            'fechaInicioEstudiosComplementarios' => 'required|date',
            'fechaFinalEstudiosComplementarios' => 'required|date|after_or_equal:fechaInicioEstudiosComplementarios',
            'estadoEstudiosComplementarios' => 'required|string|max:255',
            'idInversion' => 'required|exists:inversion,idInversion',
        ],[
            'nombreEstudiosComplementarios.required' => 'El campo Nombre Segmento es obligatorio.',
            'observacionEstudiosComplementarios.required' => 'El campo Nombre Segmento es obligatorio.',
            'fechaInicioEstudiosComplementarios.required' => 'El campo Fecha Inicio es obligatorio.',
            'fechaInicioEstudiosComplementarios.date' => 'El campo Fecha Inicio debe ser una fecha válida.',
            'fechaFinalEstudiosComplementarios.required' => 'El campo Fecha Final es obligatorio.',
            'fechaFinalEstudiosComplementarios.date' => 'El campo Fecha Final debe ser una fecha válida.',
            'fechaFinalEstudiosComplementarios.after_or_equal' => 'La Fecha Final debe ser igual o posterior a la Fecha Inicio.',
            'estadoEstudiosComplementarios.required' => 'El campo Nombre Segmento es obligatorio.',
            'idInversion.required' => 'El campo Inversión es obligatorio.',
            'idInversion.exists' => 'La inversión seleccionada no existe.',
            
        ]);
        Complementario::create($request->all());
        return redirect()->route('complementario.index')->with('message','Elemento creado correctamente.');
    }

    public function show($id){
        $complementarios = Complementario::with(['inversion'])->findOrFail($id);
        return view('complementario.show', compact('complementarios'));
    }

    public function edit($id)
    {
        $complementarios = Complementario::findOrFail($id);
        $inversiones = Inversion::all(); // Para cargar todas las inversiones
        return view('complementario.edit', compact('complementarios', 'inversiones'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreEstudiosComplementarios' => 'required|string|max:255',
            'observacionEstudiosComplementarios' => 'required|string|max:255',
            'fechaInicioEstudiosComplementarios' => 'required|date',
            'fechaFinalEstudiosComplementarios' => 'required|date|after_or_equal:fechaInicioEstudiosComplementarios',
            'estadoEstudiosComplementarios' => 'required|string|max:255',
            'idInversion' => 'required|exists:inversion,idInversion',
        ],[
            'nombreEstudiosComplementarios.required' => 'El campo Nombre Segmento es obligatorio.',
            'observacionEstudiosComplementarios.required' => 'El campo Nombre Segmento es obligatorio.',
            'fechaInicioEstudiosComplementarios.required' => 'El campo Fecha Inicio es obligatorio.',
            'fechaInicioEstudiosComplementarios.date' => 'El campo Fecha Inicio debe ser una fecha válida.',
            'fechaFinalEstudiosComplementarios.required' => 'El campo Fecha Final es obligatorio.',
            'fechaFinalEstudiosComplementarios.date' => 'El campo Fecha Final debe ser una fecha válida.',
            'fechaFinalEstudiosComplementarios.after_or_equal' => 'La Fecha Final debe ser igual o posterior a la Fecha Inicio.',
            'estadoEstudiosComplementarios.required' => 'El campo Nombre Segmento es obligatorio.',
            'idInversion.required' => 'El campo Inversión es obligatorio.',
            'idInversion.exists' => 'La inversión seleccionada no existe.',
        ]);
        $complementarios = Complementario::findOrFail($id);
        $complementarios->update($request->all());
        return redirect()->route('complementario.index')->with('message', 'Elemento actualizado correctamente.');
    }

    public function destroy($id){
        $complementarios = Complementario::findOrFail($id);
        $complementarios->delete();
        return redirect()->route('complementario.index')->with('message','Elemento eliminado correctamente.');
    }
}
