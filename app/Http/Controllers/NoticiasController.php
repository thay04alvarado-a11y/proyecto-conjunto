<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NoticiaModel;

class NoticiasController extends Controller
{
    public function index()
    {
        return view('base');
    }

    public function lista()
    {
        $noticias = NoticiaModel::all(); // Trae todas las noticias
        return view('noticias', compact('noticias'));
    }

     public function ver($id)
    {
        $noticia = NoticiaModel::find($id);
        return view('detalle_noticia', compact('noticia'));
    }
}
