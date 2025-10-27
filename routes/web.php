<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\HomeSomosController;

/* Rutas para la pagina principal */
Route::get('/',[HomeSomosController::class, 'home']);

/* Rutas para las noticias */
Route::get('/noticias',[NoticiasController::class, 'lista']);
Route::get('/noticiasDetalle/{id}', [NoticiasController::class, 'ver'])->name('noticias.ver');

/* Rutas para el home y somos */
Route::get('/home', [HomeSomosController::class, 'home']);
Route::get('/somos', [HomeSomosController::class, 'somos']);

Route::get('/login', [UsuariosController::class, 'Login']) ->name('login');
Route::post('/loginConfirmacion', [UsuariosController::class, 'loginConfi']);
Route::get('/logout', [UsuariosController::class, 'logout'])->name('logout');

//si autenticado
Route::middleware('auth')->group(function () {
    Route::match(['get', 'post'], '/dashboard/{seccion?}/{opcion?}/{id?}', [DashboardController::class, 'index'])->name('dashboard');
    
    /* Rutas para el usuario */
    Route::get('/profile', [UsuariosController::class, 'profile'])->name('profile');
    Route::get('/usuarios', [UsuariosController::class, 'usuarios'])->name('usuarios');
    Route::get('/usuarios-form', [UsuariosController::class, 'usuariosForm'])->name('usuarios-form');
    

    Route::post('/insertarUsuario', [UsuariosController::class, 'insertarUsuario']);

    Route::delete('/eliminar-usuario/{idUsuario}', [UsuariosController::class, 'destroy'])->name('eliminarUsuario');

    Route::get('/editarUsuario/{idUsuario}', [UsuariosController::class, 'editUsuario'])->name('editarUsuario');

    Route::patch('/actualizar-usuario/{idUsuario}', [UsuariosController::class, 'updateUsuario'])
        ->name('actualizar-usuario');
});




