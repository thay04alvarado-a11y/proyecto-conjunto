<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracion;

class HomeSomosController extends Controller
{
      public function home()
    {
        $configuracion = Configuracion::findorfail(1);
        return view("home", compact("configuracion"));
    }

    public function somos()
    {
        $configuracion = Configuracion::findorfail(1);
        return view("somos", compact("configuracion"));
    }
    
}
