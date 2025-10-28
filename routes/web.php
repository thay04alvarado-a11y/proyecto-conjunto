<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\HomeSomosController;

/* Rutas para la pagina principal */
Route::get('/',[NoticiasController::class, 'index']);
Route::match(['get', 'post'], '/dashboard/{seccion?}/{opcion?}/{id?}', [DashboardController::class, 'index'])->name('dashboard');

/* Rutas para el usuario */
Route::get('/profile', [UsuarioController::class, 'profile'])->name('profile');
Route::get('/login', [UsuarioController::class, 'Login']);
Route::post('/loginConfirmacion', [UsuarioController::class, 'loginConfi']);
Route::get('/logout', [UsuarioController::class, 'logout'])->name('logout');
Route::get('/usuarios', [UsuarioController::class, 'usuarios'])->name('usuarios');
Route::get('/usuarios-form', [UsuarioController::class, 'usuariosForm'])->name('usuarios-form');



Route::post('/insertarUsuario', [UsuarioController::class, 'insertarUsuario']);

Route::delete('/eliminar-usuario/{idUsuario}', [UsuarioController::class, 'destroy'])->name('eliminarUsuario');

Route::get('/editarUsuario/{idUsuario}', [UsuarioController::class, 'editUsuario'])->name('editarUsuario');

Route::patch('/actualizar-usuario/{idUsuario}', [UsuarioController::class, 'updateUsuario'])
    ->name('actualizar-usuario');


/* Rutas para las noticias */
Route::get('/noticias',[NoticiasController::class, 'lista']);
Route::get('/noticiasDetalle/{id}', [NoticiasController::class, 'ver'])->name('noticias.ver');

/* Rutas para el home y somos */
Route::get('/home', [HomeSomosController::class, 'home']);
Route::get('/somos', [HomeSomosController::class, 'somos']);

