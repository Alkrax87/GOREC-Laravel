<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inversion;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
    public function showHomeForm()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
        $notificaciones = [];
        if ($user->isAdmin) {
            $inversiones = Inversion::all();
        } else {
            $inversiones = Inversion::where('idUsuario', $user->idUsuario)->get();
        }

        foreach ($inversiones as $inversion) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversion->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 168) {
                $notificaciones[] = $inversion;
            }
        }

        // Pasar los datos del usuario a la vista
        return view('home', [
            'user' => $user,
            'notificaciones' => $notificaciones
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/login');
    }
}
