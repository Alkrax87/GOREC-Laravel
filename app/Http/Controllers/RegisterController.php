<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {

        $timestamps = false;

        $request->validate([
            'nombreUsuario' => 'required|string|max:255',
            'apellidoUsuario' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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

        // Después de registrar al usuario, redirige al usuario a la página de inicio de sesión
        return redirect('/login')->with('success', '¡Registro exitoso! Por favor inicia sesión.');
    }
}
