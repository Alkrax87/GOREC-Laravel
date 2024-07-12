<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inversion;
use App\Models\AsignacionProfesional;
use App\Models\AsignacionAsistente;
use App\Models\User;

class AsignacionesController extends Controller
{
    // Función de carga de datos
    public function index(Request $request){
        // Carga de datos de inversion
        $inversiones = Inversion::all();

        // Carga de datos de profesionales
        $profesionales = AsignacionProfesional::all();

        // Carga de datos de asistentes
        $asistentes = AsignacionAsistente::all();

        // Carga de datos de usuarios que pueden ser profesionales
        $usuariosProfesionales = User::whereNotNull('email')->where('idUsuario', '!=', 1)->get();

        // Carga de datos de usuarios que pueden ser solo asistentes
        $usuariosAsistentes = User::whereNull('email')->where('idUsuario', '!=', 1)->get();

        return view('asignaciones.index', compact('inversiones','profesionales','asistentes','usuariosProfesionales','usuariosAsistentes'));
    }
}
