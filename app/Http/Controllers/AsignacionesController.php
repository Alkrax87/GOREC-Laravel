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
            // Si el usuario es administrador, carga todas las inversiones
            $inversiones = Inversion::all();
        } else {
            // Si no es administrador, carga las inversiones propias y aquellas en las que ha sido asignado como profesional
            $inversionesPropias = Inversion::where('idUsuario', $user->idUsuario)->get();

            // Obtén las inversiones donde el usuario ha sido asignado como profesional
            $inversionesAsignadas = Inversion::whereHas('profesional', function ($query) use ($user) {
                $query->where('idUsuario', $user->idUsuario);
            })->get();

            // Combina las inversiones propias y las asignadas
            $inversiones = $inversionesPropias->merge($inversionesAsignadas)->unique('idInversion');

            $inversionIds = $inversiones->pluck('idInversion');
        }

        $notificaciones = [];
        foreach ($inversiones as $inversion) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversion->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 168) {
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
    public function update(Request $request, $id){

        $request->validate([
            'ObservacionUser' => 'nullable|string|max:1024',
        ]);

        // Buscar el asistente por ID (usando `User::findOrFail` si los asistentes están en esta tabla)
        $usuario = User::findOrFail($id);

        // Actualizar solo la observación para no sobreescribir otros datos
        $usuario->update([
            'ObservacionUser' => $request->input('ObservacionUser'),
        ]);

        return redirect()->back()->with('message_observacion', 'Observación actualizada correctamente para el asistente.');
    }
    public function showInversion($idInversion)
{
    // Suponiendo que tienes el jefe autenticado
    $jefeId = Auth::user()->id;

    // Obtén la inversión específica
    $inversion = Inversion::findOrFail($idInversion);

    // Obtén los profesionales y asistentes asignados al jefe
    $profesionales = Profesional::whereHas('asistentes', function ($query) use ($jefeId) {
        $query->where('idJefe', $jefeId);
    })->get();

    $asistentes = Asistente::where('idJefe', $jefeId)->get();

    return view('nombre_de_tu_vista', compact('inversion', 'profesionales', 'asistentes'));
}
}
