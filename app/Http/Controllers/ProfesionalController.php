<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsignacionProfesional;
use App\Models\AsignacionAsistente;

class ProfesionalController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'idInversion' => 'required|string|exists:inversion,idInversion',
            'idUsuario' => 'required|string|exists:users,idUsuario',
        ]);
        AsignacionProfesional::create($request->all());
        return redirect()->route('asignaciones.index')->with('profesional_message','Profesional agregado correctamente.');
    }

    public function destroy(Request $request) {
        $request->validate([
            'idInversion' => 'required|string|exists:inversion,idInversion',
            'idUsuario' => 'required|string|exists:users,idUsuario',
        ]);
        $idInversion = $request->idInversion;
        $idUsuario = $request->idUsuario;
        AsignacionProfesional::where('idUsuario', $idUsuario)->where('idInversion', $idInversion)->delete();
        AsignacionAsistente::where('idJefe', $idUsuario)->delete();
        return redirect()->route('asignaciones.index')->with('profesional_message', 'Elemento eliminados correctamente.');
    }
}