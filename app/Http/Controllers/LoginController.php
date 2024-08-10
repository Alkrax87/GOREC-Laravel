<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    { // o la lógica necesaria para obtener el usuario
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->input('email');
        $password = $request->input('password');

        $email = $username . '@gorec.com';

        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if (!$user->password_changed) {
                return redirect()->route('login')->with('showPasswordChangeModal', true);
            }
            return redirect()->intended('/home');
        }

        return redirect()->back()->withInput()->withErrors(['email' => 'Email o contraseña incorrectos.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

