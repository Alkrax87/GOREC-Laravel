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
use App\Http\Controllers\ComentarioControllerInversion;
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
    Route::resource('segmento', SegmentoController::class);
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
    // ======= Inversion =========
    //Route::resource('inversion', InversionController::class);
    Route::get('/inversion', [InversionController::class, 'index'])->name('inversion.index');
    Route::post('/inversion', [InversionController::class, 'store'])->name('inversion.store');
    Route::get('/inversion/edit/{id}', [InversionController::class, 'edit'])->name('inversion.edit');
    Route::post('/inversion/update/{id}', [InversionController::class, 'update'])->name('inversion.update');
    Route::get('/inversion/show/{id}', [InversionController::class, 'show'])->name('inversion.show');
    Route::get('/inversion/estadoLog/{id}', [InversionController::class, 'estadoLog'])->name('inversion.estadoLog');
    Route::get('/inversion/avanceInversionLog/{id}', [InversionController::class, 'avanceInversionLog'])->name('inversion.avanceInversionLog');
    Route::delete('/inversion/{id}', [InversionController::class, 'destroy'])->name('inversion.destroy');
    // ======= Especialidad =========
    // Route::resource('especialidad', EspecialidadController::class);
    Route::get('/especialidad', [EspecialidadController::class, 'index'])->name('especialidad.index');
    Route::post('/especialidad', [EspecialidadController::class, 'store'])->name('especialidad.store');
    Route::get('/especialidad/edit/{id}', [EspecialidadController::class, 'edit'])->name('especialidad.edit');
    Route::post('/especialidad/update/{id}', [EspecialidadController::class, 'update'])->name('especialidad.update');
    Route::get('/especialidad/show/{id}', [EspecialidadController::class, 'show'])->name('especialidad.show');
    Route::get('/especialidad/avance/{id}', [EspecialidadController::class, 'avance'])->name('especialidad.avance');
    Route::delete('/especialidad/{id}', [EspecialidadController::class, 'destroy'])->name('especialidad.destroy');

    // ======= USUARIO =========
    // Route::resource('usuario', UserController::class)->middleware([AdminMiddleware::class]);
    Route::get('/usuario', [UserController::class, 'index'])->name('usuario.index')->middleware([AdminMiddleware::class]);
    Route::post('/usuario', [UserController::class, 'store'])->name('usuario.store')->middleware([AdminMiddleware::class]);
    Route::get('/usuario/edit/{id}', [UserController::class, 'edit'])->name('usuario.edit')->middleware([AdminMiddleware::class]);
    Route::patch('/usuario/update/{id}', [UserController::class, 'update'])->name('usuario.update')->middleware([AdminMiddleware::class]);
    Route::get('/usuario/show/{id}', [UserController::class, 'show'])->name('usuario.show')->middleware([AdminMiddleware::class]);
    Route::delete('/usuario/{id}', [UserController::class, 'destroy'])->name('usuario.destroy')->middleware([AdminMiddleware::class]);

    // =========== Fase =============
    Route::resource('fase', FaseController::class)->except(['show']);
    Route::get('/especialidad/actividades/{id}', [FaseController::class, 'index'])->name('especialidad.actividades');
    Route::get('/fase/{id}', [FaseController::class, 'index'])->name('fase.index');
    Route::get('/especialidad/{id}/fase', [FaseController::class, 'index'])->name('especialidad.fase.index');

     // =========== Comentarios =============
    Route::get('/comentario', [ComentarioControllerInversion::class, 'index'])->name('comentario.index');
    Route::post('/comentario', [ComentarioControllerInversion::class, 'store'])->name('comentario.store');
    Route::get('/comentario/edit/{id}', [ComentarioControllerInversion::class, 'edit'])->name('comentario.edit');
    Route::post('/comentario/update/{id}', [ComentarioControllerInversion::class, 'update'])->name('comentario.update');
    Route::get('/comentario/show/{id}', [ComentarioControllerInversion::class, 'show'])->name('comentario.show');
    //Route::get('/comentario/avance/{id}', [ComentarioControllerInversion::class, 'avance'])->name('comentario.avance');
    Route::delete('/comentario/{id}', [ComentarioControllerInversion::class, 'destroy'])->name('comentario.destroy');
    
    // Cerrar sesión
    Route::post('/logout', 'App\Http\Controllers\HomeController@logout')->name('logout');
});
