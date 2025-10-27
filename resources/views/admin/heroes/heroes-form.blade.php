@extends('admin.layout.app')

@section('title')
<h3 class="mb-0">{{ isset($heroe) ? 'Editar Heroe' : 'Crear Heroe' }}</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('dashboard', ['seccion' => 'heroes']) }}">Heroes</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ isset($heroe) ? 'Editar' : 'Crear' }}</li>
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

  .form-control:focus {
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
    <div class="col-lg-8 mx-auto">
      <div class="card">
        <div class="card-body form-modern">
          @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <form method="POST" action="{{ route('dashboard', ['seccion' => 'heroes', 'opcion' => 'form', 'id' => isset($heroe) ? Crypt::encryptString($heroe->idHeroe) : null]) }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
              <label for="pagina" class="form-label">Página <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="pagina" name="pagina" 
                     value="{{ old('pagina', isset($heroe) ? $heroe->pagina : '') }}" required maxlength="100">
              @error('pagina')
                <div class="text-danger">{{ $message }}</div>
              @enderror
              <small class="form-text text-muted">Ej: home, about, contact, etc.</small>
            </div>

            <div class="mb-3">
              <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="titulo" name="titulo" 
                     value="{{ old('titulo', isset($heroe) ? $heroe->titulo : '') }}" required maxlength="150">
              @error('titulo')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="subtitulo" class="form-label">Subtítulo</label>
              <textarea class="form-control" id="subtitulo" name="subtitulo" 
                        rows="2" maxlength="255">{{ old('subtitulo', isset($heroe) ? $heroe->subtitulo : '') }}</textarea>
              @error('subtitulo')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="imagen" class="form-label">Imagen @if(!isset($heroe))<span class="text-danger">*</span>@endif</label>
              <input type="file" class="form-control" id="imagen" name="imagen" 
                     accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml,image/webp" @if(!isset($heroe)) required @endif>
              @error('imagen')
                <div class="text-danger">{{ $message }}</div>
              @enderror
              <small class="form-text text-muted">Formatos: JPEG, PNG, JPG, GIF, SVG, WEBP (Máx. 2MB)</small>
            </div>

            @if(isset($heroe) && isset($heroe->imagen) && $heroe->imagen)
              <div class="mb-3">
                <label class="form-label">Imagen Actual</label>
                <div>
                  <img src="{{ asset($heroe->imagen) }}" alt="Imagen actual" class="img-preview">
                </div>
                <small class="form-text text-muted">Deja vacío para mantener la imagen actual</small>
              </div>
            @endif

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-gradient-primary">
                <i class="bi bi-check-circle me-1"></i>
                {{ isset($heroe) ? 'Actualizar Heroe' : 'Crear Heroe' }}
              </button>
              <a href="{{ route('dashboard', ['seccion' => 'heroes']) }}" 
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

