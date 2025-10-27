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
        return view('noticias', compact('noticias'));
    }

     public function ver($id)
    {
        $noticia = Noticia::with('categorias')->findOrFail($id);
        return view('detalle_noticia', compact('noticia'));
    }
}
