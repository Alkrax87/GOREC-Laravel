<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsignacionAsistente;

class AsistenteController extends Controller
{
    // Función de agreagar un registro
    public function store(Request $request){
        // Validaciones
        $request->validate([
            'idInversion' => 'required|string|exists:inversion,idInversion',
            'idAsistente' => 'required|string|exists:users,idUsuario',
            'idJefe' => 'required|string|exists:users,idUsuario',
        ]);

        // Creamos una nueva asignacion de profesional
        AsignacionAsistente::create($request->all());

        return redirect()->route('asignaciones.index')->with('asistente_message','Profesional agregado correctamente.');
    }

    // Función eliminar un registro
    public function destroy(Request $request) {
        // Validaciones
        $request->validate([
            'idInversion' => 'required|string|exists:inversion,idInversion',
            'idAsistente' => 'required|string|exists:users,idUsuario',
            'idJefe' => 'required|string|exists:users,idUsuario',
        ]);

        // Asignamos el id de la inversión
        $idInversion = $request->idInversion;

        // Asignamos el id del usuario como asistente
        $idAsistente = $request->idAsistente;

        // Asignamos el id del usuario que es el jefe del asistente
        $idJefe = $request->idJefe;

        // Eliminamos el asistente
        AsignacionAsistente::where('idAsistente', $idAsistente)->where('idInversion', $idInversion)->where('idJefe', $idJefe)->delete();

        return redirect()->route('asignaciones.index')->with('asistente_message', 'Elemento eliminados correctamente.');
    }
}