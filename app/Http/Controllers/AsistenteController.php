<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsignacionAsistente;

class AsistenteController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'idInversion' => 'required|string|exists:inversion,idInversion',
            'idAsistente' => 'required|string|exists:users,idUsuario',
            'idJefe' => 'required|string|exists:users,idUsuario',
        ]);
        AsignacionAsistente::create($request->all());
        return redirect()->route('asignaciones.index')->with('asistente_message','Profesional agregado correctamente.');
    }

    public function destroy(Request $request) {
        $request->validate([
            'idInversion' => 'required|string|exists:inversion,idInversion',
            'idAsistente' => 'required|string|exists:users,idUsuario',
            'idJefe' => 'required|string|exists:users,idUsuario',
        ]);
        $idInversion = $request->idInversion;
        $idAsistente = $request->idAsistente;
        $idJefe = $request->idJefe;
        AsignacionAsistente::where('idAsistente', $idAsistente)->where('idInversion', $idInversion)->where('idJefe', $idJefe)->delete();
        return redirect()->route('asignaciones.index')->with('asistente_message', 'Elemento eliminados correctamente.');
    }
}