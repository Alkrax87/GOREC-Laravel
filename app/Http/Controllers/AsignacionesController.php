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
        $usuariosProfesionales = User::whereNotNull('email')
            ->where('idUsuario', '!=', 1)
            ->get();

        $usuariosAsistentes = User::whereNull('email')
            ->where('idUsuario', '!=', 1)
            ->get();
        return view('asignaciones.index', compact('inversiones','profesionales','asistentes','usuariosProfesionales','usuariosAsistentes'));
    }
}
