<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsignacionProfesional;
use App\Models\AsignacionAsistente;

class ProfesionalController extends Controller
{
    // Función de agreagar un registro
    public function store(Request $request){
        // Validaciones
        $request->validate([
            'idInversion' => 'required|string|exists:inversion,idInversion',
            'idUsuario' => 'required|string|exists:users,idUsuario',
        ]);

        // Creamos una nueva asignacion de profesional
        AsignacionProfesional::create($request->all());

        return redirect()->route('asignaciones.index')->with('profesional_message','Profesional agregado correctamente.');
    }

    // Función eliminar un registro
    public function destroy(Request $request) {
        // Validaciones
        $request->validate([
            'idInversion' => 'required|string|exists:inversion,idInversion',
            'idUsuario' => 'required|string|exists:users,idUsuario',
        ]);

        // Asignamos el id de la inversión
        $idInversion = $request->idInversion;

        // Asignamos el id de la del usuario
        $idUsuario = $request->idUsuario;

        // Eliminamos el profesional y sus asistentes
        AsignacionProfesional::where('idUsuario', $idUsuario)->where('idInversion', $idInversion)->delete();
        AsignacionAsistente::where('idJefe', $idUsuario)->delete();

        return redirect()->route('asignaciones.index')->with('profesional_message', 'Elemento eliminados correctamente.');
    }
}