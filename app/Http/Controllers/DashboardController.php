<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function noticiasForm()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            log::error('Error al cargar el noticias form: ' . $th->getMessage());
        }
        return view('admin.noticas.noticias-form');
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
