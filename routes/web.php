<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\NoticiasController;


Route::get('/', [UsuarioController::class, 'base']);


//Rutas keylor
Route::get('/login', [UsuarioController::class, 'Login']);
Route::post('/loginConfirmacion', [UsuarioController::class, 'loginConfi']);

Route::get('/usuarios', [UsuarioController::class, 'usuarios'])->name('usuarios');
Route::get('/usuarios-form', [UsuarioController::class, 'usuariosForm'])->name('usuarios-form');

Route::post('/insertarUsuario', [UsuarioController::class, 'insertarUsuario']);

Route::delete('/eliminar-usuario/{idUsuario}', [UsuarioController::class, 'destroy'])->name('eliminarUsuario');

Route::get('/editarUsuario/{idUsuario}', [UsuarioController::class, 'editUsuario'])->name('editarUsuario');

Route::patch('/actualizar-usuario/{idUsuario}', [UsuarioController::class, 'updateUsuario'])
    ->name('actualizar-usuario');




/* Rutas para el login */

/*  si ya esta logueado usamos un */
/* Route::middleware('auth')->group(function () { */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UsuarioController::class, 'profile'])->name('profile');
    Route::get('/logout', [UsuarioController::class, 'logout'])->name('logout');
    Route::get('/website', [WebsiteController::class, 'website'])->name('website');
    Route::get('/website-form', [WebsiteController::class, 'websiteForm'])->name('website-form');
    Route::get('/noticias', [NoticiasController::class, 'noticias'])->name('noticias');
    Route::get('/noticias-form', [NoticiasController::class, 'noticiasForm'])->name('noticias-form');
/* }); */

/*  si no esta logueado usamos el middleware guest */
/* Route::middleware('guest')->group(function () {
    Route::get('/login', [UsuarioController::class, 'login']);
}); */
