<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RolesController extends Controller
{
    // Función de carga de datos
    public function index(Request $request){
        // Carga de datos de usuarios que tengan una cuenta
        $usuarios = User::whereNotNull('email')->where('idUsuario', '!=', 1)->get();

        return view('roles.index', compact('usuarios'));
    }

    // Función editar el rol de un usuario
    public function update(Request $request, $id)
    {
        // Buscar el usuario por ID
        $usuario = User::findOrFail($id);

        // Alternar el estado de administrador
        $usuario->isAdmin = !$usuario->isAdmin;

        // Guardar los cambios
        $usuario->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('roles.index')->with('message', 'El rol del usuario ' . $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario . ' ha sido actualizado.');
    }
}