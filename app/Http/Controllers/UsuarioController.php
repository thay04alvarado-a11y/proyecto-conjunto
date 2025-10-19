<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
      public function base()
    {
        return view("home");
    }
    public function profile()
    {
        return "profile";
    }
    public function logout()
    {
        return "logout";
    }
    public function usuarios()
    {
        return view('admin.usuarios.usuarios');
    }
    public function usuariosForm()
    {
        return view('admin.usuarios.usuarios-form');
    }
    
}
