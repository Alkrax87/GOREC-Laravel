<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InversionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SegmentoController;
use App\Http\Controllers\AsignacionesController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\AsistenteController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ComplementarioController;

// Ruta por defecto
Route::get('/', function () {
    return view('login');
});

// Ruta para mostrar el formulario de login y para procesar el inicio de sesión
Route::get('/login', 'App\Http\Controllers\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\LoginController@login');

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    Route::get('/home', 'App\Http\Controllers\HomeController@showHomeForm')->name('home');
    Route::resource('inversion', InversionController::class);
    Route::resource('usuario', UserController::class);
    Route::resource('segmento', SegmentoController::class);
    Route::resource('asignaciones', AsignacionesController::class);
    Route::resource('profesional', ProfesionalController::class);
    Route::resource('asistente', AsistenteController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('avanzeProyecto', ProyectoController::class);
    Route::resource('complementario', ComplementarioController::class);

    // Middleware de administrador aplicado a la ruta del dashboard
    /*Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    });*/

    // Cerrar sesión
    Route::post('/logout', 'App\Http\Controllers\HomeController@logout')->name('logout');
});