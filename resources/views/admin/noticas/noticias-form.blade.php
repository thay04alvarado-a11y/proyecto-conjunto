@extends('admin.layout.app')

@section('title')
<h3 class="mb-0">{{ isset($noticia) ? 'Editar Noticia' : 'Crear Noticia' }}</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('dashboard', ['seccion' => 'noticias']) }}">Noticias</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ isset($noticia) ? 'Editar' : 'Crear' }}</li>
@endsection

@section('content')
<style>
  .form-modern {
    background: #ffffff;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
  }

  .form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
  }

  .form-control:focus,
  .form-select:focus,
  .form-control-file:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
  }

  .img-preview {
    max-width: 300px;
    max-height: 200px;
    border-radius: 0.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    margin-top: 1rem;
  }

  .btn-gradient-primary {
    background: linear-gradient(90deg, #0d6efd, #00b894);
    color: #fff;
    border: none;
    border-radius: 2rem;
    transition: 0.3s ease;
  }

  .btn-gradient-primary:hover {
    transform: scale(1.05);
    box-shadow: 0 0 12px rgba(13, 110, 253, 0.5);
  }

  .btn-gradient-secondary {
    background: linear-gradient(90deg, #6c757d, #495057);
    color: #fff;
    border: none;
    border-radius: 2rem;
    transition: 0.3s ease;
  }

  .btn-gradient-secondary:hover {
    transform: scale(1.05);
  }
</style>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body form-modern">
          @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <form method="POST" action="{{ route('dashboard', ['seccion' => 'noticias', 'opcion' => 'form', 'id' => isset($noticia) ? Crypt::encryptString($noticia->idNoticia) : null]) }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
              <div class="col-md-8">
                <div class="mb-3">
                  <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="titulo" name="titulo" 
                         value="{{ old('titulo', isset($noticia) ? $noticia->titulo : '') }}" required maxlength="200">
                  @error('titulo')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="descripcion_corta" class="form-label">Descripción Corta <span class="text-danger">*</span></label>
                  <textarea class="form-control" id="descripcion_corta" name="descripcion_corta" 
                            rows="3" required maxlength="300">{{ old('descripcion_corta', isset($noticia) ? $noticia->descripcion_corta : '') }}</textarea>
                  @error('descripcion_corta')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="descripcion_larga" class="form-label">Descripción Larga <span class="text-danger">*</span></label>
                  <textarea class="form-control" id="descripcion_larga" name="descripcion_larga" 
                            rows="6" required>{{ old('descripcion_larga', isset($noticia) ? $noticia->descripcion_larga : '') }}</textarea>
                  @error('descripcion_larga')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <div class="mb-3">
                  <label for="autor" class="form-label">Autor <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="autor" name="autor" 
                         value="{{ old('autor', isset($noticia) ? $noticia->autor : '') }}" required maxlength="100">
                  @error('autor')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="fecha" class="form-label">Fecha <span class="text-danger">*</span></label>
                  <input type="date" class="form-control" id="fecha" name="fecha" 
                         value="{{ old('fecha', isset($noticia) && isset($noticia->fecha) ? $noticia->fecha : date('Y-m-d')) }}" required>
                  @error('fecha')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="categorias" class="form-label">Categorías</label>
                  @if(isset($categorias) && $categorias->count() > 0)
                    <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                      @foreach($categorias as $cat)
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" 
                                 name="categorias[]" 
                                 id="categoria_{{ $cat->idCategoria }}"
                                 value="{{ $cat->idCategoria }}"
                                 {{ (collect(old('categorias', isset($noticia) && $noticia->categorias ? $noticia->categorias->pluck('idCategoria')->toArray() : []))->contains($cat->idCategoria)) ? 'checked' : '' }}>
                          <label class="form-check-label" for="categoria_{{ $cat->idCategoria }}">
                            {{ $cat->nombre }}
                          </label>
                        </div>
                      @endforeach
                    </div>
                    <small class="form-text text-muted">Puedes seleccionar múltiples categorías</small>
                  @else
                    <div class="alert alert-warning">
                      No hay categorías disponibles. 
                      <a href="{{ route('dashboard', ['seccion' => 'categorias', 'opcion' => 'form']) }}" class="alert-link">
                        <i class="bi bi-plus-circle me-1"></i>Crear categoría
                      </a>
                    </div>
                  @endif
                  @error('categorias')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                  @error('categorias.*')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="imagen" class="form-label">Imagen @if(!isset($noticia))<span class="text-danger">*</span>@endif</label>
                  <input type="file" class="form-control" id="imagen" name="imagen" 
                         accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml,image/webp" @if(!isset($noticia)) required @endif>
                  @error('imagen')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                  <small class="form-text text-muted">Formatos: JPEG, PNG, JPG, GIF, SVG, WEBP (Máx. 2MB)</small>
                </div>

                @if(isset($noticia) && isset($noticia->imagen) && $noticia->imagen)
                  <div class="mb-3">
                    <label class="form-label">Imagen Actual</label>
                    <div>
                      <img src="{{ asset($noticia->imagen) }}" alt="Imagen actual" class="img-preview">
                    </div>
                    <small class="form-text text-muted">Deja vacío para mantener la imagen actual</small>
                  </div>
                @endif
              </div>
            </div>

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-gradient-primary">
                <i class="bi bi-check-circle me-1"></i>
                {{ isset($noticia) ? 'Actualizar Noticia' : 'Crear Noticia' }}
              </button>
              <a href="{{ route('dashboard', ['seccion' => 'noticias']) }}" 
                 class="btn btn-gradient-secondary">
                <i class="bi bi-x-circle me-1"></i> Cancelar
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imagenInput = document.getElementById('imagen');
    const imagenPreview = document.querySelector('.img-preview');
    
    if (imagenInput) {
        imagenInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (imagenPreview) {
                        imagenPreview.src = e.target.result;
                    } else {
                        const previewDiv = document.createElement('div');
                        previewDiv.className = 'mb-3';
                        previewDiv.innerHTML = '<label class="form-label">Vista Previa</label><div><img src="' + e.target.result + '" class="img-preview"></div>';
                        imagenInput.parentElement.parentElement.appendChild(previewDiv);
                        imagenPreview = previewDiv.querySelector('img');
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
@endsection
