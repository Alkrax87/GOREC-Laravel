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
}
