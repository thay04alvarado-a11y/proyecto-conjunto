<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticiasController; 

Route::get('/',[NoticiasController::class, 'index']);
Route::get('/noticias',[NoticiasController::class, 'lista']);
