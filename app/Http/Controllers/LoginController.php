<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            // Si las credenciales son válidas, redirige al usuario a la página de inicio
            return redirect()->intended('/home');
        }

        // Si las credenciales son inválidas, redirige al usuario de vuelta al formulario de inicio de sesión
        return redirect()->back()->withInput()->withErrors(['email' => 'Email o contraseña incorrectos.']);
    }
}
