<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoticiasController extends Controller
{
    //
    function noticias()
    {
        return view('admin.noticas.noticias');
    }
    function noticiasForm()
    {
        return view('admin.noticas.noticias-form');
    }
}
