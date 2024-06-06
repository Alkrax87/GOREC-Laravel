<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inversion;
use App\Models\AsignacionProfesional;
use App\Models\User;

class AsignacionesController extends Controller
{
    public function index(Request $request){
        $inversiones = Inversion::all();
        $profesionales = AsignacionProfesional::all();
        $usuarios = User::all();
        return view('asignaciones.index', compact('inversiones','profesionales','usuarios'));
    }

    public function store(Request $request){
        $request->validate([
            'idInversion' => 'required|string|max:255|exists:inversion,idInversion',
            'idUsuario' => 'required|string|max:255|exists:users,idUsuario',
        ]);
        AsignacionProfesional::create($request->all());
        return redirect()->route('asignaciones.index')->with('profesional_message','Profesional agregado correctamente.');
    }

    public function destroy(Request $request) {
        $idInversion = $request->idInversion;
        $idUsuario = $request->idUsuario;
        AsignacionProfesional::where('idUsuario', $idUsuario)->where('idInversion', $idInversion)->delete();
        return redirect()->route('asignaciones.index')->with('profesional_message', 'Elemento eliminados correctamente.');
    }
}
