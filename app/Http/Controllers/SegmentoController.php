<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segmento;

class SegmentoController extends Controller
{
    public function index(Request $request){
        $segmentos = Segmento::with(['inversion', 'usuario'])->get();
        return view('segmento.index', compact('segmentos'));
    }

    public function create(){
        return view('segmento.create');
    }

    public function store(Request $request){
        $request->validate([
            // Aquí debes definir las reglas de validación para tus campos
        ]);
        Segmento::create($request->all());
        return redirect()->route('segmento.index')->with('message','Elemento creado correctamente.');
    }

    public function show($id){
        $segmento = Segmento::with(['inversion', 'usuario'])->findOrFail($id);
        return view('segmento.show', compact('segmento'));
    }
/*
    public function edit($id){
        $segmento = Segmento::findOrFail($id);
        return view('segmento.edit', compact('segmento'));
    }

    public function update(Request $request, $id){
        $request->validate([
            // Aquí debes definir las reglas de validación para tus campos
        ]);
        $segmento = Segmento::findOrFail($id);
        $segmento->update($request->all());
        return redirect()->route('segmento.index')->with('message','Elemento actualizado correctamente.');
    }
*/

    public function edit($id)
    {
        $segmento = Segmento::findOrFail($id);
        $inversiones = Inversion::all(); // Para cargar todas las inversiones
        $usuarios = User::all(); // Para cargar todos los usuarios
        return view('segmento.edit', compact('segmento', 'inversiones', 'usuarios'));
    }

    public function update(Request $request, $id)
    {

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
