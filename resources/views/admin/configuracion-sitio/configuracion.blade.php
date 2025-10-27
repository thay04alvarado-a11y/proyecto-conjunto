@extends('admin.layout.app')

@section('title')
<h3 class="mb-0">Configuración del Sitio</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active" aria-current="page">Configuración</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="card">
        <div class="card-body">
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <h4 class="card-title mb-4"><strong>Configuración del Sitio Web</strong></h4>

          @if(isset($configuracion))
            <div class="row">
              <div class="col-md-4 text-center mb-3">
                @if($configuracion->logo_sitio)
                  <img src="{{ asset($configuracion->logo_sitio) }}" alt="Logo" class="img-fluid" style="max-height: 200px;">
                @else
                  <div class="alert alert-secondary">No hay logo configurado</div>
                @endif
              </div>
              <div class="col-md-8">
                <p><strong>Nombre del Sitio:</strong> {{ $configuracion->nombre_sitio }}</p>
                <p><strong>Estado:</strong> 
                  <span class="badge {{ $configuracion->activo ? 'bg-success' : 'bg-secondary' }}">
                    {{ $configuracion->activo ? 'Activo' : 'Inactivo' }}
                  </span>
                </p>
              </div>
            </div>

            <div class="mt-4">
              <a href="{{ route('dashboard', ['seccion' => 'configuracion', 'opcion' => 'form']) }}" 
                 class="btn btn-gradient-primary">
                <i class="bi bi-pencil me-1"></i> Editar Configuración
              </a>
            </div>
          @else
            <div class="alert alert-info">
              <i class="bi bi-info-circle me-2"></i>
              No hay configuración registrada.
              <a href="{{ route('dashboard', ['seccion' => 'configuracion', 'opcion' => 'form']) }}" 
                 class="btn btn-gradient-primary btn-sm ms-2">
                <i class="bi bi-plus-circle"></i> Crear Configuración
              </a>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

