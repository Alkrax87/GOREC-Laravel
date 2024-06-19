<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function showHomeForm()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Pasar los datos del usuario a la vista
        return view('home', ['user' => $user]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/login');
    }
}
