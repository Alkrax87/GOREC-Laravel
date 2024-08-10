<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsignacionAsistente;
use App\Models\User;
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
    
        // Verifica si el asistente ya está asignado al mismo jefe en la misma inversión
        $existeAsignacion = AsignacionAsistente::where('idInversion', $request->idInversion)
                                               ->where('idAsistente', $request->idAsistente)
                                               ->where('idJefe', $request->idJefe)
                                               ->exists();
    
        if ($existeAsignacion) {
            return redirect()->back()->with('error_asistente', 'El asistente ya está asignado a este jefe en esta inversión.')->withInput();
        }
    
        // Obtener el nombre completo del asistente
        $asistente = User::find($request->idAsistente);
        $nombreAsistente = $asistente->nombreUsuario . ' ' . $asistente->apellidoUsuario;
     // Obtener el nombre completo del usuario
        $jefe = User::find($request->idJefe); // Suponiendo que tu modelo de usuario se llama `User`
        $nombrejefe = $jefe->nombreUsuario . ' ' . $jefe->apellidoUsuario;
        // Creamos una nueva asignación de asistente
        AsignacionAsistente::create($request->all());
    
        // Redirigir con el mensaje de éxito
        return redirect()->route('asignaciones.index')->with('asistente_message', 'Asistente ' . $nombreAsistente . ' asignado correctamente al jefe ' .  $nombrejefe);
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

        return redirect()->route('asignaciones.index')->with('asistente_message', 'Asistente eliminado correctamente.');
    }
}