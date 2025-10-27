@extends('admin.layout.app')

@section('title')
<h3 class="mb-0">{{ isset($seccion) ? 'Editar Sección' : 'Crear Sección' }}</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('dashboard', ['seccion' => 'secciones']) }}">Secciones</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ isset($seccion) ? 'Editar' : 'Crear' }}</li>
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
  .form-select:focus {
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

  .form-check-input:checked {
    background-color: #00b894;
    border-color: #00b894;
  }

  .form-check-input:focus {
    border-color: #0d6efd;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
  }
</style>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="card">
        <div class="card-body form-modern">
          @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <form method="POST" action="{{ route('dashboard', ['seccion' => 'secciones', 'opcion' => 'form', 'id' => isset($seccion) ? Crypt::encryptString($seccion->idSeccion) : null]) }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
              <label for="identificador" class="form-label">Identificador <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="identificador" name="identificador" 
                     value="{{ old('identificador', isset($seccion) ? $seccion->identificador : '') }}" required maxlength="100">
              @error('identificador')
                <div class="text-danger">{{ $message }}</div>
              @enderror
              <small class="form-text text-muted">Ej: periodo_matricula, semana_u, etc.</small>
            </div>

            <div class="mb-3">
              <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="titulo" name="titulo" 
                     value="{{ old('titulo', isset($seccion) ? $seccion->titulo : '') }}" required maxlength="150">
              @error('titulo')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="parrafo" class="form-label">Párrafo</label>
              <textarea class="form-control" id="parrafo" name="parrafo" 
                        rows="4">{{ old('parrafo', isset($seccion) ? $seccion->parrafo : '') }}</textarea>
              @error('parrafo')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="imagen" class="form-label">Imagen</label>
              <input type="file" class="form-control" id="imagen" name="imagen" 
                     accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml,image/webp">
              @error('imagen')
                <div class="text-danger">{{ $message }}</div>
              @enderror
              <small class="form-text text-muted">Formatos: JPEG, PNG, JPG, GIF, SVG, WEBP (Máx. 2MB)</small>
            </div>

            @if(isset($seccion) && isset($seccion->imagen) && $seccion->imagen)
              <div class="mb-3">
                <label class="form-label">Imagen Actual</label>
                <div>
                  <img src="{{ asset($seccion->imagen) }}" alt="Imagen actual" class="img-preview">
                </div>
                <small class="form-text text-muted">Deja vacío para mantener la imagen actual</small>
              </div>
            @endif

            <div class="mb-4">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="activo" name="activo" 
                       {{ old('activo', isset($seccion) ? $seccion->activo : true) ? 'checked' : '' }}>
                <label class="form-check-label" for="activo">
                  <strong>Estado Activo</strong>
                </label>
              </div>
              <small class="form-text text-muted">Las secciones inactivas no se mostrarán en el sitio</small>
            </div>

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-gradient-primary">
                <i class="bi bi-check-circle me-1"></i>
                {{ isset($seccion) ? 'Actualizar Sección' : 'Crear Sección' }}
              </button>
              <a href="{{ route('dashboard', ['seccion' => 'secciones']) }}" 
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
    
    if (imagenInput) {
        imagenInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    let previewDiv = document.querySelector('#img-preview-container');
                    if (!previewDiv) {
                        previewDiv = document.createElement('div');
                        previewDiv.id = 'img-preview-container';
                        previewDiv.className = 'mb-3';
                        previewDiv.innerHTML = '<label class="form-label">Vista Previa</label><div><img src="" class="img-preview"></div>';
                        imagenInput.parentElement.appendChild(previewDiv);
                    }
                    previewDiv.querySelector('img').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
@endsection

