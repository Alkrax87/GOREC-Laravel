<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function showHomeForm()
    {
        return view('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/login');
    }
}
