<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Heroe;
use App\Models\Seccion;

class HomeSomosController extends Controller
{
    public function home()
    {
        $heroe = Heroe::where('pagina', 'home')->first();
        $secciones = Seccion::where('identificador', 'LIKE', 'home_%')->where('activo', 1)->get();
        return view("home", compact('heroe', 'secciones'));
    }

    public function somos()
    {
        $heroe = Heroe::where('pagina', 'somos')->first();
        $secciones = Seccion::where('identificador', 'LIKE', 'somos_%')->where('activo', 1)->get();
        return view("somos", compact('heroe', 'secciones'));
    }
    
}
