<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Categoria;
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
                        return $this->noticiasForm($id);
                        break;
                    default:
                        return $this->noticias();
                        break;
                }
                break;
            case 'categorias':
                switch ($opcion) {
                    case 'form':
                        return $this->categoriasForm($id);
                        break;
                    default:
                        return $this->categorias();
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
            $noticias = Noticia::with('categoria')->orderBy('created_at', 'desc')->get();
            $categorias = \App\Models\Categoria::where('activo', 1)->get();
            return view('admin.noticas.noticias', compact('noticias', 'categorias'));
        } catch (\Throwable $th) {
            Log::error('Error al cargar el noticias: ' . $th->getMessage());
            return view('admin.noticas.noticias', ['noticias' => collect([]), 'categorias' => collect([])]);
        }
    }
    public function noticiasForm($id = null)
    {
        $request = request();
        try {
            $categorias = \App\Models\Categoria::where('activo', 1)->get();
            
            // Si viene por POST, procesar el formulario
            if ($request->isMethod('post')) {
                $validated = $request->validate([
                    'titulo' => 'required|string|max:200',
                    'descripcion_corta' => 'required|string|max:300',
                    'descripcion_larga' => 'required|string',
                    'autor' => 'required|string|max:100',
                    'fecha' => 'required|date',
                    'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                    'id_categoria' => 'nullable|integer'
                ]);

                // Manejar la imagen
                if ($request->hasFile('imagen')) {
                    $archivo = $request->file('imagen');
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    $destino = public_path('assets/img/noticias');
                    
                    // Crear directorio si no existe
                    if (!file_exists($destino)) {
                        mkdir($destino, 0755, true);
                    }
                    
                    $archivo->move($destino, $nombreArchivo);
                    $validated['imagen'] = 'assets/img/noticias/' . $nombreArchivo;
                } else {
                    // Si no hay nueva imagen y estamos editando, mantener la imagen existente
                    unset($validated['imagen']);
                }

                if ($id) {
                    $idnew = Crypt::decryptString($id);
                    $noticia = Noticia::findOrFail($idnew);
                    $noticia->update($validated);
                    $mensaje = 'Noticia actualizada correctamente';
                } else {
                    Noticia::create($validated);
                    $mensaje = 'Noticia creada correctamente';
                }
                
                return redirect()->route('dashboard', ['seccion' => 'noticias'])->with('success', $mensaje);
            }

            // Si hay ID, cargar la noticia para editar
            if ($id) {
                $idnew = Crypt::decryptString($id);
                $noticia = Noticia::findOrFail($idnew);
                return view('admin.noticas.noticias-form', compact('noticia', 'categorias'));
            }

            return view('admin.noticas.noticias-form', compact('categorias'));
            
        } catch (\Throwable $th) {
            Log::error('Error en noticias form: ' . $th->getMessage());
            return redirect()->route('dashboard', ['seccion' => 'noticias'])->with('error', 'Error al procesar el formulario');
        }
    }
    
    public function EliminarNoticia($id)
    {
        try {
            $idnew = Crypt::decryptString($id);
            $noticia = Noticia::findOrFail($idnew);
            
            // Eliminar imagen si existe
            if ($noticia->imagen && file_exists(public_path($noticia->imagen))) {
                unlink(public_path($noticia->imagen));
            }
            
            $noticia->delete();
            return redirect()->route('dashboard', ['seccion' => 'noticias'])->with('success', 'Noticia eliminada correctamente');
        } catch (\Throwable $th) {
            Log::error('Error al eliminar la noticia: ' . $th->getMessage());
            return redirect()->route('dashboard', ['seccion' => 'noticias'])->with('error', 'Error al eliminar la noticia');
        }
    }


    //categorias
    public function categorias()
    {
        try {
            $categorias = Categoria::orderBy('created_at', 'desc')->get();
            return view('admin.categorias.categorias', compact('categorias'));
        } catch (\Throwable $th) {
            Log::error('Error al cargar categorías: ' . $th->getMessage());
            return view('admin.categorias.categorias', ['categorias' => collect([])]);
        }
    }

    public function categoriasForm($id = null)
    {
        $request = request();
        try {
            // Si viene por POST, procesar el formulario
            if ($request->isMethod('post')) {
                $validated = $request->validate([
                    'nombre' => 'required|string|max:100',
                    'descripcion' => 'required|string|max:500',
                ]);

                // Convertir checkbox a boolean
                $validated['activo'] = $request->has('activo') ? 1 : 0;

                if ($id) {
                    $idnew = Crypt::decryptString($id);
                    $categoria = Categoria::findOrFail($idnew);
                    $categoria->update($validated);
                    $mensaje = 'Categoría actualizada correctamente';
                } else {
                    Categoria::create($validated);
                    $mensaje = 'Categoría creada correctamente';
                }
                
                return redirect()->route('dashboard', ['seccion' => 'categorias'])->with('success', $mensaje);
            }

            // Si hay ID, cargar la categoría para editar
            if ($id) {
                $idnew = Crypt::decryptString($id);
                $categoria = Categoria::findOrFail($idnew);
                return view('admin.categorias.categorias-form', compact('categoria'));
            }

            return view('admin.categorias.categorias-form');
            
        } catch (\Throwable $th) {
            Log::error('Error en categorias form: ' . $th->getMessage());
            return redirect()->route('dashboard', ['seccion' => 'categorias'])->with('error', 'Error al procesar el formulario');
        }
    }

    public function EliminarCategoria($id)
    {
        try {
            $idnew = Crypt::decryptString($id);
            $categoria = Categoria::findOrFail($idnew);
            $categoria->delete();
            return redirect()->route('dashboard', ['seccion' => 'categorias'])->with('success', 'Categoría eliminada correctamente');
        } catch (\Throwable $th) {
            Log::error('Error al eliminar la categoría: ' . $th->getMessage());
            return redirect()->route('dashboard', ['seccion' => 'categorias'])->with('error', 'Error al eliminar la categoría');
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
