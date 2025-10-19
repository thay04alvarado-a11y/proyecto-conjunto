<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\NoticiasController; 

Route::get('/',[NoticiasController::class, 'index']);
Route::get('/noticias',[NoticiasController::class, 'lista']);
Route::get('/noticiasDetalle/{id}', [NoticiasController::class, 'ver'])->name('noticias.ver');



//Route::get('/', [UsuarioController::class, 'base']);

