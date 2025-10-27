@extends('admin.layout.app')

@section('title')
<h3 class="mb-0">Editar Hero de {{ ucfirst($nombrePagina) }}</h3>
@endsection

@section('content')
<style>
  .form-modern {
    background: #ffffff;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
  }
</style>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="card">
        <div class="card-body form-modern">
          <form method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="pagina" value="{{ $nombrePagina }}">

            <div class="mb-3">
              <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="titulo" name="titulo" 
                     value="{{ old('titulo', $heroe->titulo ?? '') }}" required maxlength="150">
            </div>

            <div class="mb-3">
              <label for="subtitulo" class="form-label">Subtítulo</label>
              <textarea class="form-control" id="subtitulo" name="subtitulo" rows="2" maxlength="255">{{ old('subtitulo', $heroe->subtitulo ?? '') }}</textarea>
            </div>

            <div class="mb-3">
              <label for="imagen" class="form-label">Imagen {{ !isset($heroe) ? '<span class="text-danger">*</span>' : '' }}</label>
              <input type="file" class="form-control" id="imagen" name="imagen" 
                     accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml,image/webp" {{ !isset($heroe) ? 'required' : '' }}>
              <small class="form-text text-muted">Formatos: JPEG, PNG, JPG, GIF, SVG, WEBP (Máx. 2MB)</small>
            </div>

            @if(isset($heroe) && $heroe->imagen)
              <div class="mb-3">
                <img src="{{ asset($heroe->imagen) }}" alt="Imagen actual" style="max-width: 300px; border-radius: 0.5rem;">
                <p class="text-muted">Imagen actual</p>
              </div>
            @endif

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-gradient-primary">
                <i class="bi bi-check-circle me-1"></i> {{ isset($heroe) ? 'Actualizar' : 'Crear' }}
              </button>
              <a href="{{ route('dashboard', ['seccion' => 'pagina', 'opcion' => $nombrePagina]) }}" 
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
@endsection

