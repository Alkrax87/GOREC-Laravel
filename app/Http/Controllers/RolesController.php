<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Inversion;
use Carbon\Carbon;

class RolesController extends Controller
{
    // Función de carga de datos
    public function index(Request $request){
        // Carga de datos de usuarios que tengan una cuenta
        $usuarios = User::whereNotNull('email')->where('idUsuario', '!=', 1)->get();
        $inversiones = Inversion::all();

        $notificaciones = [];
        foreach ($inversiones as $inversion) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversion->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 168) {
                $notificaciones[] = $inversion;
            }
        }

        return view('roles.index', compact('usuarios','notificaciones'));
    }

    // Función editar el rol de un usuario
    public function update(Request $request, $id)
    {
        // Buscar el usuario por ID
        $usuario = User::findOrFail($id);

        if ($request->value === '0') {
            // Alternar el estado de administrador
            $usuario->isAdmin = !$usuario->isAdmin;

            // Guardar los cambios
            $usuario->save();
        } else if ($request->value === '1') {

            // Alternar el estado de administrador
            $usuario->isAdministrativo = !$usuario->isAdministrativo;

            // Guardar los cambios
            $usuario->save();
        }


        // Redirigir con un mensaje de éxito
        return redirect()->route('roles.index')->with('message', 'El rol del usuario ' . $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario . ' ha sido actualizado.');
    }
}