<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class UserController extends Controller
{
    // Funcion de Listar
    public function index()
    {
        $users = User::paginate(10); // CambInversion::
        return view('usuario.index', compact('users'));
    }

    // Funcion retornar vista create
    public function create()
    {
        return view('usuario.create');
    }

    // Funcion subir a la BD
    public function store(Request $request)
    {
        $request->validate([
            'nombreUsuario' => 'required|string|max:255',
            'apellidoUsuario' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'profesionUsuario' => 'nullable|string|max:255',
            'especialidadUsuario' => 'nullable|string|max:255',
        ]);

        User::create([
            'nombreUsuario' => $request->nombreUsuario,
            'apellidoUsuario' => $request->apellidoUsuario,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profesionUsuario' => $request->profesionUsuario,
            'especialidadUsuario' => $request->especialidadUsuario,
        ]);

        return redirect()->route('usuario.index')->with('success','Inversión creada exitosamente.');
    }


    // Funcion completar datos al formulario de editar usuario
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuario.edit',compact('usuario'));
    }

    // Funcion editar usuario
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreUsuario' => 'required|string|max:255',
            'apellidoUsuario' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'profesionUsuario' => 'nullable|string|max:255',
            'especialidadUsuario' => 'nullable|string|max:255',
        ]);

        // Buscar el usuario por ID
        $usuario = User::findOrFail($id);

        $usuario->update([
            'nombreUsuario' => $request->nombreUsuario,
            'apellidoUsuario' => $request->apellidoUsuario,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profesionUsuario' => $request->profesionUsuario,
            'especialidadUsuario' => $request->especialidadUsuario,
        ]);

        // Actualizar los datos del usuario
        //$usuario->update($request->all());

        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuario.index')->with('success','Inversión eliminada exitosamente.');
    }

    // Funcion ver
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuario.show', compact('usuario'));
    }
}
