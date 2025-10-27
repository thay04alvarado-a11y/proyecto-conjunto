<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;

class NoticiasController extends Controller
{

    public function index()
    {
        return view('base');
    }

    public function lista()
    {
        $noticias = Noticia::with('categorias')->whereNotNull('imagen')->orderBy('created_at', 'desc')->get();
        $heroe = \App\Models\Heroe::where('pagina', 'noticias')->first();
        $secciones = \App\Models\Seccion::where('identificador', 'LIKE', 'noticias_%')->where('activo', 1)->get();
        return view('noticias', compact('noticias', 'heroe', 'secciones'));
    }

     public function ver($id)
    {
        $noticia = Noticia::with('categorias')->findOrFail($id);
        return view('detalle_noticia', compact('noticia'));
    }
}
