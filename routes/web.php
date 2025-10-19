<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\HomeSomosController;

/* Rutas para la pagina principal */
Route::get('/',[NoticiasController::class, 'index']);

/* Rutas para el dashboard */
Route::match(['get', 'post'], '/dashboard/{seccion?}/{opcion?}/{id?}', [DashboardController::class, 'index'])->name('dashboard');

/* Rutas para el usuario */
Route::get('/profile', [UsuarioController::class, 'profile'])->name('profile');
Route::get('/logout', [UsuarioController::class, 'logout'])->name('logout');
Route::get('/usuarios', [UsuarioController::class, 'usuarios'])->name('usuarios');
Route::get('/usuarios-form', [UsuarioController::class, 'usuariosForm'])->name('usuarios-form');

/* Rutas para las noticias */
Route::get('/noticias',[NoticiasController::class, 'lista']);
Route::get('/noticiasDetalle/{id}', [NoticiasController::class, 'ver'])->name('noticias.ver');

/* Rutas para el home y somos */
Route::get('/home', [HomeSomosController::class, 'home']);
Route::get('/somos', [HomeSomosController::class, 'somos']);


