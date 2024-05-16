<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Ruta para mostrar el formulario de login
Route::get('/login', 'App\Http\Controllers\LoginController@showLoginForm')->name('login');
// Ruta para procesar el inicio de sesión
Route::post('/login', 'App\Http\Controllers\LoginController@login');

// Ruta para mostrar el formulario de registro
Route::get('/register', 'App\Http\Controllers\RegisterController@showRegistrationForm')->name('register');
// Ruta para procesar el registro de usuario
Route::post('/register', 'App\Http\Controllers\RegisterController@register');

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    // Ruta para mostrar la página de inicio (home)
    Route::get('/home', 'App\Http\Controllers\HomeController@showHomeForm')->name('home');

    // Middleware de administrador aplicado a la ruta del dashboard
    /*Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    });*/

    // Ruta para cerrar sesión
    Route::post('/logout', 'App\Http\Controllers\HomeController@logout')->name('logout');
});




