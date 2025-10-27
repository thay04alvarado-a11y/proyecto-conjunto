<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    //aca cree un administrador de secciones y opciones para cada seccion
    public function index($seccion = null, $opcion = null, $id = null)
    {
        switch ($seccion) {
            case 'noticias':
                switch ($opcion) {
                    case 'form':
                        return $this->noticiasForm();
                        break;
                        default:
                            return $this->noticias();
                            break;
                }
                break;
            case 'website':
                switch ($opcion) {
                    case 'form':
                        return $this->websiteForm();
                        break;
                    default:
                        return $this->website();
                        break;
                }
            default:
                return $this->dashboard();
                break;
        }
    }
    //aca van las funciones que se llaman en cada seccion para que el organizador no crezca tanto
    //como ejemplo:
    public function dashboard()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            log::error('Error al cargar el dashboard: ' . $th->getMessage());
        }
        return view('admin.dashboard');
    }
    
    //noticias
    public function noticias()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            log::error('Error al cargar el noticias: ' . $th->getMessage());
        }
        return view('admin.noticas.noticias');
    }
    public function noticiasForm($id = null)
    {
        $request = request();
        try {
            if ($id) {
                $idnew = Crypt::decryptString($id);
                $noticia = Noticia::find($idnew);
                if (!$noticia) {
                    return redirect()->route('noticias')->with('error', 'Noticia no encontrada');
                }
                if ($request->isMethod('post')) {
                    $validated = $request->validate([
                        'titulo' => 'required|string|max:200',
                        'descripcion_corta' => 'required|string|max:300',
                        'descripcion_larga' => 'required|string',
                        'autor' => 'required|string|max:100',
                        'fecha' => 'required|date',
                        'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);
                    $nuevanoticia = Noticia::updateOrCreate(['idNoticia' => $idnew], $validated);
                    return redirect()->route('noticias')->with('success', 'Noticia actualizada correctamente');
                }


                return view('admin.noticas.noticias-form', compact('noticia'));
            }
        } catch (\Throwable $th) {
            log::error('Error al cargar el noticias form: ' . $th->getMessage());
        }
        return view('admin.noticas.noticias-form');
    }
    
    public function EliminarNoticia($id)
    {
        try {
            $noticia = Noticia::find($id);
            if (!$noticia) {
                return redirect()->route('noticias')->with('error', 'Noticia no encontrada');
            }
            $noticia->delete();
            return redirect()->route('noticias')->with('success', 'Noticia eliminada correctamente');
        } catch (\Throwable $th) {
            log::error('Error al eliminar la noticia: ' . $th->getMessage());
            return redirect()->route('noticias')->with('error', 'Error al eliminar la noticia');
        }
    }


    //website
    
    function website()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            log::error('Error al cargar el website: ' . $th->getMessage());
        }
        return view('admin.website.website');
    }
    function websiteForm()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            log::error('Error al cargar el website: ' . $th->getMessage());
        }
        return view('admin.website.website-form');
    }

}
