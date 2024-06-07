<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RolesController extends Controller
{
    public function index(Request $request){
        $usuarios = User::all(); // Carga todos los usuarios
        return view('roles.index', compact('usuarios'));
    }

    public function update(Request $request, $id)
    {
        // Buscar el usuario por ID
        $usuario = User::findOrFail($id);

        // Alternar el estado de administrador
        $usuario->isAdmin = !$usuario->isAdmin;

        // Guardar los cambios
        $usuario->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('roles.index')->with('message', 'El estado de administrador del usuario ha sido actualizado.');
    }
}
