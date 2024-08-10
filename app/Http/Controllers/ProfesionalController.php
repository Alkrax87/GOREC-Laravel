<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsignacionProfesional;
use App\Models\AsignacionAsistente;
use App\Models\User;

class ProfesionalController extends Controller
{
    // Función de agreagar un registro
    public function store(Request $request){
        // Validaciones
        $request->validate([
            'idInversion' => 'required|string|exists:inversion,idInversion',
            'idUsuario' => 'required|string|exists:users,idUsuario',
        ]);
    
        // Verifica si el profesional ya está asignado a la misma inversión
        $existeAsignacion = AsignacionProfesional::where('idInversion', $request->idInversion)
                                                ->where('idUsuario', $request->idUsuario)
                                                ->exists();
    
        if ($existeAsignacion) {
            return redirect()->back()->with('error', 'El profesional ya está asignado a esta inversión.')->withInput();
        }
         // Obtener el nombre completo del usuario
        $usuario = User::find($request->idUsuario); // Suponiendo que tu modelo de usuario se llama `User`
        $nombreCompleto = $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario;
        // Creamos una nueva asignacion de profesional
        AsignacionProfesional::create($request->all());
    
        return redirect()->route('asignaciones.index')->with('profesional_message','Profesional ' .  $nombreCompleto . ' agregado correctamente.');
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

        return redirect()->route('asignaciones.index')->with('profesional_message', 'Profesional eliminado correctamente.');
    }
}