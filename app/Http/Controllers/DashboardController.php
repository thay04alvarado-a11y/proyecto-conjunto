<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('admin.dashboard');
    }
    
    //noticias
    public function noticias()
    {
        return view('admin.noticas.noticias');
    }
    public function noticiasForm()
    {
        return view('admin.noticas.noticias-form');
    }

    //website
    
    function website()
    {
        return view('admin.website.website');
    }
    function websiteForm()
    {
        return view('admin.website.website-form');
    }

}
