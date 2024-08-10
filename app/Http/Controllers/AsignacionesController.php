<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inversion;
use App\Models\AsignacionProfesional;
use App\Models\AsignacionAsistente;
use App\Models\User;
use Carbon\Carbon;
use Auth;

class AsignacionesController extends Controller
{
    // Función de carga de datos
    public function index(Request $request){
        // Cargamos los datos de inversion filtrador en base al usuario logeado
        $user = Auth::user();
        if ($user->isAdmin) {
            $inversiones = Inversion::all();
        } else {
            $inversiones = Inversion::where('idUsuario', $user->idUsuario)->get();
        }

        $notificaciones = [];
        foreach ($inversiones as $inversion) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversion->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 48) {
                $notificaciones[] = $inversion;
            }
        }

        // Carga de datos de profesionales
        $profesionales = AsignacionProfesional::all();

        // Carga de datos de asistentes
        $asistentes = AsignacionAsistente::all();

        // Carga de datos de usuarios que pueden ser profesionales
        $usuariosProfesionales = User::whereNotNull('email')->where('idUsuario', '!=', 1)->get();

        // Carga de datos de usuarios que pueden ser solo asistentes
        $usuariosAsistentes = User::whereNull('email')->where('idUsuario', '!=', 1)->get();

        return view('asignaciones.index', compact('inversiones','profesionales','asistentes','usuariosProfesionales','usuariosAsistentes','notificaciones'));
    }
}
