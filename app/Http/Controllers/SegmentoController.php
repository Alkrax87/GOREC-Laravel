<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segmento;
use App\Models\Inversion;
use App\Models\User;

class SegmentoController extends Controller
{
    public function index(Request $request){
        $segmentos = Segmento::with(['inversion', 'usuario'])->get();
        $inversiones = Inversion::all(); // Carga todas las inversiones
        $usuarios = User::all(); // Carga todos los usuarios
        return view('segmento.index', compact('segmentos', 'inversiones', 'usuarios'));
    }

    public function create(){
        $inversiones = Inversion::all(); // Para cargar todas las inversiones
        $usuarios = User::all(); // Carga todos los usuarios
        return view('segmento.create', compact('inversiones', 'usuarios'));
    }

    public function store(Request $request){
        $request->validate([
            'nombreSegmento' => 'required|string|max:255',
            'fechaInicioSegmento' => 'required|date',
            'fechaFinalSegmento' => 'required|date|after_or_equal:fechaInicioSegmento',
            'idInversion' => 'required|exists:inversion,idInversion',
            'idUsuario' => 'required|exists:users,idUsuario',
        ],[
            'nombreSegmento.required' => 'El campo Nombre Segmento es obligatorio.',
            'fechaInicioSegmento.required' => 'El campo Fecha Inicio es obligatorio.',
            'fechaInicioSegmento.date' => 'El campo Fecha Inicio debe ser una fecha válida.',
            'fechaFinalSegmento.required' => 'El campo Fecha Final es obligatorio.',
            'fechaFinalSegmento.date' => 'El campo Fecha Final debe ser una fecha válida.',
            'fechaFinalSegmento.after_or_equal' => 'La Fecha Final debe ser igual o posterior a la Fecha Inicio.',
            'idInversion.required' => 'El campo Inversión es obligatorio.',
            'idInversion.exists' => 'La inversión seleccionada no existe.',
            'idUsuario.required' => 'El campo Usuario es obligatorio.',
            'idUsuario.exists' => 'El usuario seleccionado no existe.',
        ]);
        Segmento::create($request->all());
        return redirect()->route('segmento.index')->with('message','Elemento creado correctamente.');
    }

    public function show($id){
        $segmento = Segmento::with(['inversion', 'usuario'])->findOrFail($id);
        return view('segmento.show', compact('segmento'));
    }

    public function edit($id)
    {
        $segmento = Segmento::findOrFail($id);
        $inversiones = Inversion::all(); // Para cargar todas las inversiones
        $usuarios = User::all(); // Carga todos los usuarios
        return view('segmento.edit', compact('segmento', 'inversiones', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreSegmento' => 'required|string|max:255',
            'fechaInicioSegmento' => 'required|date',
            'fechaFinalSegmento' => 'required|date|after_or_equal:fechaInicioSegmento',
            'idInversion' => 'required|exists:inversion,idInversion',
            'idUsuario' => 'required|exists:users,idUsuario',
        ],[
            'nombreSegmento.required' => 'El campo Nombre Segmento es obligatorio.',
            'fechaInicioSegmento.required' => 'El campo Fecha Inicio es obligatorio.',
            'fechaInicioSegmento.date' => 'El campo Fecha Inicio debe ser una fecha válida.',
            'fechaFinalSegmento.required' => 'El campo Fecha Final es obligatorio.',
            'fechaFinalSegmento.date' => 'El campo Fecha Final debe ser una fecha válida.',
            'fechaFinalSegmento.after_or_equal' => 'La Fecha Final debe ser igual o posterior a la Fecha Inicio.',
            'idInversion.required' => 'El campo Inversión es obligatorio.',
            'idInversion.exists' => 'La inversión seleccionada no existe.',
            'idUsuario.required' => 'El campo Usuario es obligatorio.',
            'idUsuario.exists' => 'El usuario seleccionado no existe.',
        ]);
        $segmento = Segmento::findOrFail($id);
        $segmento->update($request->all());
        return redirect()->route('segmento.index')->with('message', 'Elemento actualizado correctamente.');
    }

    public function destroy($id){
        $segmento = Segmento::findOrFail($id);
        $segmento->delete();
        return redirect()->route('segmento.index')->with('message','Elemento eliminado correctamente.');
    }
}
