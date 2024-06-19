<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class UserController extends Controller
{
    public function index(Request $request){
        $usuarios = User::all(); // Carga todos los usuarios
        return view('usuario.index', compact('usuarios'));
    }

    public function create(){
        return view('usuario.create');
    }

    public function store(Request $request){
        $request->validate([
            'nombreUsuario' => 'required|string|max:255',
            'apellidoUsuario' => 'required|string|max:255',
            'email' => 'nullable|string|max:255|unique:users',
            'password' => 'nullable|string|min:8',
            'profesionUsuario' => 'nullable|string|max:255',
            'especialidadUsuario' => 'nullable|string|max:255',
        ], [
            'nombreUsuario.required' => 'El nombre de usuario es obligatorio.',
            'apellidoUsuario.required' => 'El apellido de usuario es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        User::create([
            'nombreUsuario' => $request->nombreUsuario,
            'apellidoUsuario' => $request->apellidoUsuario,
            'email' => $request->email . '@gorec.com',
            'password' => Hash::make($request->password),
            'profesionUsuario' => $request->profesionUsuario,
            'especialidadUsuario' => $request->especialidadUsuario,
        ]);

        return redirect()->route('usuario.index')->with('message','Elemento creado correctamente.');
    }

    public function show($id){
        $usuario = User::findOrFail($id);
        return view('usuario.show', compact('usuario'));
    }

    public function edit($id){
        $usuario = User::findOrFail($id);
        return view('usuario.edit',compact('usuario'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nombreUsuario' => 'required|string|max:255',
            'apellidoUsuario' => 'required|string|max:255',
            'email' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
            'profesionUsuario' => 'nullable|string|max:255',
            'especialidadUsuario' => 'nullable|string|max:255',
        ], [
            'nombreUsuario.required' => 'El nombre de usuario es obligatorio.',
            'apellidoUsuario.required' => 'El apellido de usuario es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        // Buscar el usuario por ID
        $usuario = User::findOrFail($id);

        $usuario->nombreUsuario = $request->nombreUsuario;
        $usuario->apellidoUsuario = $request->apellidoUsuario;
        $usuario->email = $request->email . '@gorec.com';
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        $usuario->profesionUsuario = $request->profesionUsuario;
        $usuario->especialidadUsuario = $request->especialidadUsuario;

        $usuario->save();

        return redirect()->route('usuario.index')->with('message', 'Elemento actualizado correctamente.');
    }

    // Eliminar un usuario
    public function destroy($id){
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuario.index')->with('message','Elemento eliminado correctamente.');
    }

}
