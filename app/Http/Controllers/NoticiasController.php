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
        $noticias = NoticiasModel::all(); // Trae todas las noticias
        return view('noticias', compact('noticias'));
    }
}
