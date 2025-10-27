<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Categoria;
use App\Models\Heroe;
use App\Models\Seccion;
use App\Models\ConfiguracionSitio;
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
            case 'pagina':
                // Usa el $opcion como nombre de la página
                switch ($opcion) {
                    case 'hero-form':
                        return $this->heroForm();
                        break;
                    case 'seccion-form':
                        return $this->seccionForm($id);
                        break;
                    case 'eliminar-heroe':
                        return $this->eliminarHeroePage();
                        break;
                    case 'eliminar-seccion':
                        return $this->eliminarSeccionPage();
                        break;
                    default:
                        // $opcion es el nombre real de la página (home, somos, noticias)
                        return $this->configurarPagina($opcion);
                            break;
                }
                break;
            case 'configuracion':
                switch ($opcion) {
                    case 'form':
                        return $this->configuracionForm();
                        break;
                    default:
                        return $this->configuracion();
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
            $noticias = Noticia::with('categorias')->orderBy('created_at', 'desc')->get();
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
                    'categorias' => 'nullable|array',
                    'categorias.*' => 'integer|exists:categorias,idCategoria'
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
                    
                    // Sincronizar categorías
                    if ($request->has('categorias')) {
                        $noticia->categorias()->sync($request->categorias);
                    } else {
                        $noticia->categorias()->detach();
                    }
                    
                    $mensaje = 'Noticia actualizada correctamente';
                } else {
                    $noticia = Noticia::create($validated);
                    
                    // Asociar categorías
                    if ($request->has('categorias')) {
                        $noticia->categorias()->attach($request->categorias);
                    }
                    
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

    // Configuración de página (heró y secciones dinámicas)
    public function configurarPagina($nombrePagina)
    {
        try {
            $heroe = Heroe::where('pagina', $nombrePagina)->first();
            // Filtrar secciones que empiecen exactamente con: {nombrePagina}_
            $secciones = Seccion::where('identificador', 'LIKE', $nombrePagina . '_%')->get();
            
            return view('admin.configuracion.pagina', compact('nombrePagina', 'heroe', 'secciones'));
        } catch (\Throwable $th) {
            Log::error('Error al cargar configuración de página: ' . $th->getMessage());
            return view('admin.configuracion.pagina', [
                'nombrePagina' => $nombrePagina,
                'heroe' => null,
                'secciones' => collect([])
            ]);
        }
    }

    public function heroForm()
    {
        try {
            $request = request();
            $nombrePagina = $request->input('pagina', $request->query('pagina'));
            
            if ($request->isMethod('post')) {
                $validated = $request->validate([
                    'pagina' => 'required|string|max:100',
                    'titulo' => 'required|string|max:150',
                    'subtitulo' => 'nullable|string|max:255',
                    'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                ]);

                if ($request->hasFile('imagen')) {
                    $archivo = $request->file('imagen');
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    $destino = public_path('assets/img/heroes');
                    
                    if (!file_exists($destino)) {
                        mkdir($destino, 0755, true);
                    }
                    
                    $archivo->move($destino, $nombreArchivo);
                    $validated['imagen'] = 'assets/img/heroes/' . $nombreArchivo;
                } else {
                    unset($validated['imagen']);
                }

                // Buscar si ya existe un hero para esta página
                $heroe = Heroe::where('pagina', $nombrePagina)->first();
                
                if ($heroe) {
                    $heroe->update($validated);
                    $mensaje = 'Hero actualizado correctamente';
                } else {
                    Heroe::create($validated);
                    $mensaje = 'Hero creado correctamente';
                }
                
                return redirect()->route('dashboard', ['seccion' => 'pagina', 'opcion' => $nombrePagina])->with('success', $mensaje);
            }

            $heroe = Heroe::where('pagina', $nombrePagina)->first();
            return view('admin.configuracion.hero-form', compact('nombrePagina', 'heroe'));
            
        } catch (\Throwable $th) {
            Log::error('Error en hero form: ' . $th->getMessage());
            return redirect()->route('dashboard', ['seccion' => 'pagina', 'opcion' => $nombrePagina])->with('error', 'Error al procesar el formulario');
        }
    }

    public function seccionForm($id = null)
    {
        try {
            $request = request();
            $nombrePagina = $request->input('pagina', $request->query('pagina'));
            
            if ($request->isMethod('post')) {
                $validated = $request->validate([
                    'identificador' => 'required|string|max:100',
                    'titulo' => 'required|string|max:150',
                    'parrafo' => 'nullable|string',
                    'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                ]);

                $validated['activo'] = $request->has('activo') ? 1 : 0;

                if ($request->hasFile('imagen')) {
                    $archivo = $request->file('imagen');
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    $destino = public_path('assets/img/secciones');
                    
                    if (!file_exists($destino)) {
                        mkdir($destino, 0755, true);
                    }
                    
                    $archivo->move($destino, $nombreArchivo);
                    $validated['imagen'] = 'assets/img/secciones/' . $nombreArchivo;
                } else {
                    unset($validated['imagen']);
                }

                if ($id) {
                    $idnew = Crypt::decryptString($id);
                    $seccion = Seccion::findOrFail($idnew);
                    $seccion->update($validated);
                    $mensaje = 'Sección actualizada correctamente';
                } else {
                    Seccion::create($validated);
                    $mensaje = 'Sección creada correctamente';
                }
                
                return redirect()->route('dashboard', ['seccion' => 'pagina', 'opcion' => $nombrePagina])->with('success', $mensaje);
            }

            if ($id) {
                $idnew = Crypt::decryptString($id);
                $seccion = Seccion::findOrFail($idnew);
                return view('admin.configuracion.seccion-form', compact('nombrePagina', 'seccion'));
            }

            return view('admin.configuracion.seccion-form', compact('nombrePagina'));
            
        } catch (\Throwable $th) {
            Log::error('Error en seccion form: ' . $th->getMessage());
            return redirect()->route('dashboard', ['seccion' => 'pagina', 'opcion' => $nombrePagina])->with('error', 'Error al procesar el formulario');
        }
    }

    public function eliminarHeroePage()
    {
        try {
            $request = request();
            $nombrePagina = $request->input('pagina');
            $heroe = Heroe::where('pagina', $nombrePagina)->firstOrFail();
            
            if ($heroe->imagen && file_exists(public_path($heroe->imagen))) {
                unlink(public_path($heroe->imagen));
            }
            
            $heroe->delete();
            return redirect()->route('dashboard', ['seccion' => 'pagina', 'opcion' => $nombrePagina])->with('success', 'Hero eliminado correctamente');
        } catch (\Throwable $th) {
            Log::error('Error al eliminar heroe: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Error al eliminar el hero');
        }
    }

    public function eliminarSeccionPage()
    {
        try {
            $request = request();
            $nombrePagina = $request->input('pagina');
            $id = $request->input('id');
            $idnew = Crypt::decryptString($id);
            $seccion = Seccion::findOrFail($idnew);
            
            if ($seccion->imagen && file_exists(public_path($seccion->imagen))) {
                unlink(public_path($seccion->imagen));
            }
            
            $seccion->delete();
            return redirect()->route('dashboard', ['seccion' => 'pagina', 'opcion' => $nombrePagina])->with('success', 'Sección eliminada correctamente');
        } catch (\Throwable $th) {
            Log::error('Error al eliminar sección: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Error al eliminar la sección');
        }
    }

    // Funciones antiguas (mantener compatibilidad)
    public function heroes()
    {
        try {
            $heroes = Heroe::orderBy('created_at', 'desc')->get();
            return view('admin.heroes.heroes', compact('heroes'));
        } catch (\Throwable $th) {
            Log::error('Error al cargar heroes: ' . $th->getMessage());
            return view('admin.heroes.heroes', ['heroes' => collect([])]);
        }
    }

    public function heroesForm($id = null)
    {
        $request = request();
        try {
            if ($request->isMethod('post')) {
                $validated = $request->validate([
                    'pagina' => 'required|string|max:100',
                    'titulo' => 'required|string|max:150',
                    'subtitulo' => 'nullable|string|max:255',
                    'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                ]);

                // Manejar la imagen
                if ($request->hasFile('imagen')) {
                    $archivo = $request->file('imagen');
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    $destino = public_path('assets/img/heroes');
                    
                    if (!file_exists($destino)) {
                        mkdir($destino, 0755, true);
                    }
                    
                    $archivo->move($destino, $nombreArchivo);
                    $validated['imagen'] = 'assets/img/heroes/' . $nombreArchivo;
                } else {
                    unset($validated['imagen']);
                }

                if ($id) {
                    $idnew = Crypt::decryptString($id);
                    $heroe = Heroe::findOrFail($idnew);
                    $heroe->update($validated);
                    $mensaje = 'Heroe actualizado correctamente';
                } else {
                    Heroe::create($validated);
                    $mensaje = 'Heroe creado correctamente';
                }
                
                return redirect()->route('dashboard', ['seccion' => 'heroes'])->with('success', $mensaje);
            }

            if ($id) {
                $idnew = Crypt::decryptString($id);
                $heroe = Heroe::findOrFail($idnew);
                return view('admin.heroes.heroes-form', compact('heroe'));
            }

            return view('admin.heroes.heroes-form');
            
        } catch (\Throwable $th) {
            Log::error('Error en heroes form: ' . $th->getMessage());
            return redirect()->route('dashboard', ['seccion' => 'heroes'])->with('error', 'Error al procesar el formulario');
        }
    }

    public function EliminarHeroe($id)
    {
        try {
            $idnew = Crypt::decryptString($id);
            $heroe = Heroe::findOrFail($idnew);
            
            if ($heroe->imagen && file_exists(public_path($heroe->imagen))) {
                unlink(public_path($heroe->imagen));
            }
            
            $heroe->delete();
            return redirect()->route('dashboard', ['seccion' => 'heroes'])->with('success', 'Heroe eliminado correctamente');
        } catch (\Throwable $th) {
            Log::error('Error al eliminar heroe: ' . $th->getMessage());
            return redirect()->route('dashboard', ['seccion' => 'heroes'])->with('error', 'Error al eliminar el heroe');
        }
    }

    //secciones
    public function secciones()
    {
        try {
            $secciones = Seccion::orderBy('created_at', 'desc')->get();
            return view('admin.secciones.secciones', compact('secciones'));
        } catch (\Throwable $th) {
            Log::error('Error al cargar secciones: ' . $th->getMessage());
            return view('admin.secciones.secciones', ['secciones' => collect([])]);
        }
    }

    public function seccionesForm($id = null)
    {
        $request = request();
        try {
            if ($request->isMethod('post')) {
                $validated = $request->validate([
                    'identificador' => 'required|string|max:100',
                    'titulo' => 'required|string|max:150',
                    'parrafo' => 'nullable|string',
                    'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                ]);

                $validated['activo'] = $request->has('activo') ? 1 : 0;

                // Manejar la imagen
                if ($request->hasFile('imagen')) {
                    $archivo = $request->file('imagen');
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    $destino = public_path('assets/img/secciones');
                    
                    if (!file_exists($destino)) {
                        mkdir($destino, 0755, true);
                    }
                    
                    $archivo->move($destino, $nombreArchivo);
                    $validated['imagen'] = 'assets/img/secciones/' . $nombreArchivo;
                } else {
                    unset($validated['imagen']);
                }

                if ($id) {
                    $idnew = Crypt::decryptString($id);
                    $seccion = Seccion::findOrFail($idnew);
                    $seccion->update($validated);
                    $mensaje = 'Sección actualizada correctamente';
                } else {
                    Seccion::create($validated);
                    $mensaje = 'Sección creada correctamente';
                }
                
                return redirect()->route('dashboard', ['seccion' => 'secciones'])->with('success', $mensaje);
            }

            if ($id) {
                $idnew = Crypt::decryptString($id);
                $seccion = Seccion::findOrFail($idnew);
                return view('admin.secciones.secciones-form', compact('seccion'));
            }

            return view('admin.secciones.secciones-form');
            
        } catch (\Throwable $th) {
            Log::error('Error en secciones form: ' . $th->getMessage());
            return redirect()->route('dashboard', ['seccion' => 'secciones'])->with('error', 'Error al procesar el formulario');
        }
    }

    public function EliminarSeccion($id)
    {
        try {
            $idnew = Crypt::decryptString($id);
            $seccion = Seccion::findOrFail($idnew);
            
            if ($seccion->imagen && file_exists(public_path($seccion->imagen))) {
                unlink(public_path($seccion->imagen));
            }
            
            $seccion->delete();
            return redirect()->route('dashboard', ['seccion' => 'secciones'])->with('success', 'Sección eliminada correctamente');
        } catch (\Throwable $th) {
            Log::error('Error al eliminar sección: ' . $th->getMessage());
            return redirect()->route('dashboard', ['seccion' => 'secciones'])->with('error', 'Error al eliminar la sección');
        }
    }

    //configuracion sitio
    public function configuracion()
    {
        try {
            $configuracion = ConfiguracionSitio::where('activo', 1)->first();
            return view('admin.configuracion-sitio.configuracion', compact('configuracion'));
        } catch (\Throwable $th) {
            Log::error('Error al cargar configuración: ' . $th->getMessage());
            return view('admin.configuracion-sitio.configuracion', ['configuracion' => null]);
        }
    }

    public function configuracionForm()
    {
        $request = request();
        try {
            if ($request->isMethod('post')) {
                $validated = $request->validate([
                    'nombre_sitio' => 'required|string|max:150',
                    'logo_sitio' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                ]);

                // Manejar el logo
                if ($request->hasFile('logo_sitio')) {
                    $archivo = $request->file('logo_sitio');
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    $destino = public_path('assets/img');
                    
                    if (!file_exists($destino)) {
                        mkdir($destino, 0755, true);
                    }
                    
                    $archivo->move($destino, $nombreArchivo);
                    $validated['logo_sitio'] = 'assets/img/' . $nombreArchivo;
                } else {
                    unset($validated['logo_sitio']);
                }

                $validated['activo'] = 1;

                // Actualizar o crear configuración
                $config = ConfiguracionSitio::where('activo', 1)->first();
                if ($config) {
                    $config->update($validated);
                    $mensaje = 'Configuración actualizada correctamente';
                } else {
                    ConfiguracionSitio::create($validated);
                    $mensaje = 'Configuración creada correctamente';
                }
                
                return redirect()->route('dashboard', ['seccion' => 'configuracion'])->with('success', $mensaje);
            }

            $configuracion = ConfiguracionSitio::where('activo', 1)->first();
            return view('admin.configuracion-sitio.configuracion-form', compact('configuracion'));
            
        } catch (\Throwable $th) {
            Log::error('Error en configuración form: ' . $th->getMessage());
            return redirect()->route('dashboard', ['seccion' => 'configuracion'])->with('error', 'Error al procesar el formulario');
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
