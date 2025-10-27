@extends('admin.layout.app')

@section('title')
<h3 class="mb-0">{{ isset($seccion) ? 'Editar' : 'Crear' }} Sección de {{ ucfirst($nombrePagina) }}</h3>
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
              <label for="identificador" class="form-label">Identificador <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="identificador" name="identificador" 
                     value="{{ old('identificador', isset($seccion) ? $seccion->identificador : $nombrePagina . '_') }}" required maxlength="100">
              <small class="form-text text-muted">Ej: {{ $nombrePagina }}_seccion1, {{ $nombrePagina }}_servicios, etc.</small>
            </div>

            <div class="mb-3">
              <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="titulo" name="titulo" 
                     value="{{ old('titulo', isset($seccion) ? $seccion->titulo : '') }}" required maxlength="150">
            </div>

            <div class="mb-3">
              <label for="parrafo" class="form-label">Párrafo</label>
              <textarea class="form-control" id="parrafo" name="parrafo" rows="4">{{ old('parrafo', isset($seccion) ? $seccion->parrafo : '') }}</textarea>
            </div>

            <div class="mb-3">
              <label for="imagen" class="form-label">Imagen</label>
              <input type="file" class="form-control" id="imagen" name="imagen" accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml,image/webp">
              <small class="form-text text-muted">Formatos: JPEG, PNG, JPG, GIF, SVG, WEBP (Máx. 2MB)</small>
            </div>

            @if(isset($seccion) && $seccion->imagen)
              <div class="mb-3">
                <img src="{{ asset($seccion->imagen) }}" alt="Imagen actual" style="max-width: 300px; border-radius: 0.5rem;">
                <p class="text-muted">Imagen actual</p>
              </div>
            @endif

            <div class="mb-3 form-check form-switch">
              <input class="form-check-input" type="checkbox" id="activo" name="activo" {{ old('activo', isset($seccion) ? $seccion->activo : true) ? 'checked' : '' }}>
              <label class="form-check-label" for="activo">
                <strong>Estado Activo</strong>
              </label>
            </div>

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-gradient-primary">
                <i class="bi bi-check-circle me-1"></i> {{ isset($seccion) ? 'Actualizar' : 'Crear' }}
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

