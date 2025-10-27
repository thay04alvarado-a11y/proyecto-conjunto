@extends('admin.layout.app')

@section('title')
<h3 class="mb-0">Configurar Sitio Web</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('dashboard', ['seccion' => 'configuracion']) }}">Configuración</a></li>
<li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
<style>
  .form-modern {
    background: #ffffff;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
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

          <form method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
              <label for="nombre_sitio" class="form-label fw-bold">Nombre del Sitio <span class="text-danger">*</span></label>
              <input type="text" class="form-control form-control-lg" id="nombre_sitio" name="nombre_sitio" 
                     value="{{ old('nombre_sitio', isset($configuracion) ? $configuracion->nombre_sitio : '') }}" required maxlength="150">
              <small class="form-text text-muted">Este nombre aparecerá en el sitio web</small>
            </div>

            <div class="mb-4">
              <label for="logo_sitio" class="form-label fw-bold">Logo del Sitio</label>
              <input type="file" class="form-control" id="logo_sitio" name="logo_sitio" 
                     accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml,image/webp">
              <small class="form-text text-muted">Formatos: JPEG, PNG, JPG, GIF, SVG, WEBP (Máx. 2MB)</small>
            </div>

            @if(isset($configuracion) && $configuracion->logo_sitio)
              <div class="mb-4">
                <label class="form-label fw-bold">Logo Actual</label>
                <div>
                  <img src="{{ asset($configuracion->logo_sitio) }}" alt="Logo actual" class="img-preview">
                </div>
                <small class="form-text text-muted">Deja vacío para mantener el logo actual</small>
              </div>
            @endif

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-gradient-primary">
                <i class="bi bi-check-circle me-1"></i>
                {{ isset($configuracion) ? 'Actualizar Configuración' : 'Guardar Configuración' }}
              </button>
              <a href="{{ route('dashboard', ['seccion' => 'configuracion']) }}" 
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

