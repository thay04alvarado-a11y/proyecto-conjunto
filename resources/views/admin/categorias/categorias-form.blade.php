@extends('admin.layout.app')

@section('title')
<h3 class="mb-0">{{ isset($categoria) ? 'Editar Categoría' : 'Crear Categoría' }}</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('dashboard', ['seccion' => 'categorias']) }}">Categorías</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ isset($categoria) ? 'Editar' : 'Crear' }}</li>
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

          <form method="POST" action="{{ route('dashboard', ['seccion' => 'categorias', 'opcion' => 'form', 'id' => isset($categoria) ? Crypt::encryptString($categoria->idCategoria) : null]) }}">
            @csrf

            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre de la Categoría <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="nombre" name="nombre" 
                     value="{{ old('nombre', isset($categoria) ? $categoria->nombre : '') }}" required maxlength="100">
              @error('nombre')
                <div class="text-danger">{{ $message }}</div>
              @enderror
              <small class="form-text text-muted">Máximo 100 caracteres</small>
            </div>

            <div class="mb-3">
              <label for="descripcion" class="form-label">Descripción <span class="text-danger">*</span></label>
              <textarea class="form-control" id="descripcion" name="descripcion" 
                        rows="4" required maxlength="500">{{ old('descripcion', isset($categoria) ? $categoria->descripcion : '') }}</textarea>
              @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
              @enderror
              <small class="form-text text-muted">Máximo 500 caracteres</small>
            </div>

            <div class="mb-4">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="activo" name="activo" 
                       {{ old('activo', isset($categoria) ? $categoria->activo : true) ? 'checked' : '' }}>
                <label class="form-check-label" for="activo">
                  <strong>Estado Activo</strong>
                </label>
              </div>
              <small class="form-text text-muted">Las categorías inactivas no se mostrarán en las opciones de noticias</small>
            </div>

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-gradient-primary">
                <i class="bi bi-check-circle me-1"></i>
                {{ isset($categoria) ? 'Actualizar Categoría' : 'Crear Categoría' }}
              </button>
              <a href="{{ route('dashboard', ['seccion' => 'categorias']) }}" 
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

