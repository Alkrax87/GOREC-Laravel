<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InversionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SegmentoController;
use App\Http\Controllers\AsignacionesController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\AsistenteController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\ComplementarioController;
use App\Http\Controllers\SubFaseController;
use App\Http\Controllers\FaseController;
use App\Http\Controllers\Reportes;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AdministradorMiddleware;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\BienesController;
use App\Http\Controllers\ListaInversionesAsigController;
// Ruta por defecto
Route::get('/', function () {
    return view('login');
});

// Ruta para mostrar el formulario de login y para procesar el inicio de sesión
Route::get('/login', 'App\Http\Controllers\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\LoginController@login');

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    Route::get('inversion/pdfs', [InversionController::class, 'pdfs'])->name('inversion.pdfs');
    Route::get('inversion/pdf/{id}', [InversionController::class, 'pdf'])->name('inversion.pdf');
    Route::get('especialidad/pdf', [EspecialidadController::class, 'pdf'])->name('especialidad.pdf');
    Route::get('/home', 'App\Http\Controllers\HomeController@showHomeForm')->name('home');
    Route::resource('inversion', InversionController::class);
    Route::resource('usuario', UserController::class)->middleware([AdminMiddleware::class]);
    Route::resource('roles', RolesController::class)->middleware([AdminMiddleware::class]);
    Route::resource('segmento', SegmentoController::class)->middleware([AdminMiddleware::class]);
    Route::resource('asignaciones', AsignacionesController::class);
    Route::resource('profesional', ProfesionalController::class);
    Route::resource('asistente', AsistenteController::class);

    Route::resource('complementario', ComplementarioController::class);
    Route::resource('subfase', SubFaseController::class);
    Route::resource('reportes', Reportes::class);
    Route::resource('servicios', ServiciosController::class)->middleware([AdministradorMiddleware::class]);
    Route::resource('bienes', BienesController::class)->middleware([AdministradorMiddleware::class]);
    Route::resource('listaInversion', ListaInversionesAsigController::class)->middleware([AdministradorMiddleware::class]);
    Route::get('/usuarios-por-inversion/{idInversion}', [EspecialidadController::class, 'getUsuariosPorInversion']);
    Route::get('/inversion/{id}/download', [InversionController::class, 'download'])->name('inversion.download');
    Route::get('/usuarios-por-servicios/{idInversion}', [ServiciosController::class, 'getUsuariosPorInversiones']);
    Route::get('/usuarios-por-bienes/{idInversion}', [BienesController::class, 'getUsuariosPorInversiones_bs']);
    Route::get('password/change', [UserController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('password/update', [UserController::class, 'updatePassword'])->name('password.update');

    // =========== Reportes =============
    // Ruta de Obtener avance de Inverion
    Route::get('reportes/inversion/{idInversion}/avanceInversion', [Reportes::class, 'obtenerAvanceInversion']);
    Route::get('reportes/inversion/{idInversion}/especialidad', [Reportes::class, 'getEspecialidades']);
    Route::get('/reportes/especialidad/{idEspecialidad}/fase', [Reportes::class, 'getFases']);
    Route::get('/reportes/fase/{idFase}/subfase', [Reportes::class, 'getSubFases']);

    Route::post('reportes/generate-pdf', [Reportes::class, 'generatePDF'])->name('reportes.graficos');

    // ======= Especialidad =========
    // Route::resource('especialidad', EspecialidadController::class);
    Route::get('/especialidad', [EspecialidadController::class, 'index'])->name('especialidad.index');
    Route::post('/especialidad', [EspecialidadController::class, 'store'])->name('especialidad.store');
    Route::get('/especialidad/edit/{id}', [EspecialidadController::class, 'edit'])->name('especialidad.edit');
    Route::post('/especialidad/update/{id}', [EspecialidadController::class, 'update'])->name('especialidad.update');
    Route::get('/especialidad/show/{id}', [EspecialidadController::class, 'show'])->name('especialidad.show');
    Route::get('/especialidad/avance/{id}', [EspecialidadController::class, 'avance'])->name('especialidad.avance');
    Route::delete('/especialidad/{id}', [EspecialidadController::class, 'destroy'])->name('especialidad.destroy');

    // =========== Fase =============
    Route::resource('fase', FaseController::class);
    Route::get('/especialidad/actividades/{id}', [FaseController::class, 'index'])->name('especialidad.actividades');


    // Cerrar sesión
    Route::post('/logout', 'App\Http\Controllers\HomeController@logout')->name('logout');
});
