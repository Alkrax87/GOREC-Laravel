<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inversion;
use App\Models\User;
use App\Models\AsignacionProfesional;
class ListaInversionesAsigController extends Controller
{
    //
    public function index(Request $request)
    {
        // Cargar todas las inversiones con profesionales (proyectistas) y asistentes
        $inversiones = Inversion::with(['profesional.usuario', 'asistente.jefe', 'asistente.usuario'])->get();

        return view('listaInversion.index', compact('inversiones'));
    }
}
