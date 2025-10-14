<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::get('/', [UsuarioController::class, 'base']);



Route::get('/login', [UsuarioController::class, 'Login']);

Route::post('/loginConfirmacion', [UsuarioController::class, 'loginConfi']);

