<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inversion;
use App\Models\AsignacionProfesional;
use App\Models\AsignacionAsistente;
use App\Models\User;

class AsignacionesController extends Controller
{
    public function index(Request $request){
        $inversiones = Inversion::all();
        $profesionales = AsignacionProfesional::all();
        $asistentes = AsignacionAsistente::all();
        $usuarios = User::all();
        return view('asignaciones.index', compact('inversiones','profesionales','asistentes','usuarios'));
    }

    public function store(Request $request){
        $request->validate([
            'idInversion' => 'required|string|max:255|exists:inversion,idInversion',
            'idUsuario' => 'required|string|max:255|exists:users,idUsuario',
        ]);
        AsignacionProfesional::create($request->all());
        return redirect()->route('asignaciones.index')->with('profesional_message','Profesional agregado correctamente.');
    }

    public function storeAsistente(Request $request){
        $request->validate([
            'idInversion' => 'required|string|max:255|exists:inversion,idInversion',
            'idAsistente' => 'required|string|max:255|exists:users,idUsuario',
            'idJefe' => 'required|string|max:255|exists:users,idUsuario',
        ]);
        AsignacionAsistente::create($request->all());
        return redirect()->route('asignaciones.index')->with('asistente_message','Profesional agregado correctamente.');
    }

    public function destroy(Request $request) {
        $idInversion = $request->idInversion;
        $idUsuario = $request->idUsuario;
        AsignacionProfesional::where('idUsuario', $idUsuario)->where('idInversion', $idInversion)->delete();
        AsignacionAsistente::where('idJefe', $idUsuario)->delete();
        return redirect()->route('asignaciones.index')->with('profesional_message', 'Elemento eliminados correctamente.');
    }

    public function destroyAsistente(Request $request) {
        $idInversion = $request->idInversion;
        $idAsistente = $request->idAsistente;
        AsignacionAsistente::where('idAsistente', $idAsistente)->where('idInversion', $idInversion)->delete();
        return redirect()->route('asignaciones.index')->with('profesional_message', 'Elemento eliminados correctamente.');
    }
}
