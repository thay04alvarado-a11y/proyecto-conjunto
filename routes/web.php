<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeSomosController;

Route::get('/', [HomeSomosController::class, 'home']);
Route::get('/somos', [HomeSomosController::class, 'somos']);

