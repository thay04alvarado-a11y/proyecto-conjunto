<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeSomosController extends Controller
{
      public function home()
    {
        return view("home");
    }

    public function somos()
    {
        return view("somos");
    }
    
}
