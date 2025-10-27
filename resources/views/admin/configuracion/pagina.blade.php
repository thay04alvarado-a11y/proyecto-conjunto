@extends('admin.layout.app')

@section('title')
<h3 class="mb-0">Configuración: {{ ucfirst($nombrePagina) }}</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ ucfirst($nombrePagina) }}</li>
@endsection

@section('content')
<style>
  .config-card {
    background: #ffffff;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    margin-bottom: 2rem;
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

  .btn-gradient-danger {
    background: linear-gradient(90deg, #ff4757, #ff6b81);
    color: #fff;
    border: none;
    border-radius: 2rem;
    transition: 0.3s ease;
  }

  .btn-gradient-danger:hover {
    transform: scale(1.05);
    box-shadow: 0 0 12px rgba(255, 107, 129, 0.5);
  }

  .img-preview {
    max-width: 200px;
    max-height: 120px;
    object-fit: cover;
    border-radius: 0.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }
</style>

<div class="container-fluid">
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

  <h4 class="mb-4"><strong>Gestión de {{ ucfirst($nombrePagina) }}</strong></h4>

  <!-- Hero Section -->
  <div class="card config-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="mb-0"><i class="bi bi-image me-2"></i>Hero Section</h5>
      @if($heroe)
        <form method="POST" action="{{ route('dashboard', ['seccion' => 'pagina', 'opcion' => 'eliminar-heroe']) }}" style="display: inline;">
          @csrf
          <input type="hidden" name="pagina" value="{{ $nombrePagina }}">
          <button type="submit" class="btn btn-sm btn-gradient-danger" onclick="return confirm('¿Eliminar el hero?')">
            <i class="bi bi-trash"></i> Eliminar
          </button>
        </form>
      @endif
    </div>

    @if($heroe)
      <div class="row">
        <div class="col-md-4">
          @if($heroe->imagen)
            <img src="{{ asset($heroe->imagen) }}" alt="Hero" class="img-preview">
          @else
            <div class="alert alert-warning">Sin imagen</div>
          @endif
        </div>
        <div class="col-md-8">
          <p><strong>Título:</strong> {{ $heroe->titulo }}</p>
          <p><strong>Subtítulo:</strong> {{ $heroe->subtitulo ?? 'N/A' }}</p>
          <a href="{{ route('dashboard', ['seccion' => 'pagina', 'opcion' => 'hero-form']) }}?pagina={{ $nombrePagina }}" class="btn btn-gradient-primary btn-sm">
            <i class="bi bi-pencil"></i> Editar Hero
          </a>
        </div>
      </div>
    @else
      <div class="alert alert-info">
        <i class="bi bi-info-circle me-2"></i>
        No hay hero configurado para esta página.
        <a href="{{ route('dashboard', ['seccion' => 'pagina', 'opcion' => 'hero-form']) }}?pagina={{ $nombrePagina }}" class="btn btn-gradient-primary btn-sm ms-2">
          <i class="bi bi-plus-circle"></i> Crear Hero
        </a>
      </div>
    @endif
  </div>

  <!-- Secciones -->
  <div class="card config-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="mb-0"><i class="bi bi-columns me-2"></i>Secciones</h5>
      <a href="{{ route('dashboard', ['seccion' => 'pagina', 'opcion' => 'seccion-form']) }}?pagina={{ $nombrePagina }}" class="btn btn-gradient-primary btn-sm">
        <i class="bi bi-plus-circle"></i> Agregar Sección
      </a>
    </div>

    @if($secciones->count() > 0)
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Imagen</th>
              <th>Identificador</th>
              <th>Título</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($secciones as $s)
            <tr>
              <td>{{ $s->idSeccion }}</td>
              <td>
                @if($s->imagen)
                  <img src="{{ asset($s->imagen) }}" alt="{{ $s->titulo }}" class="img-preview">
                @else
                  <span class="text-muted">Sin imagen</span>
                @endif
              </td>
              <td><code>{{ $s->identificador }}</code></td>
              <td>{{ Str::limit($s->titulo, 40) }}</td>
              <td>
                <span class="badge {{ $s->activo ? 'bg-success' : 'bg-secondary' }}">
                  {{ $s->activo ? 'Activo' : 'Inactivo' }}
                </span>
              </td>
              <td>
                <a href="{{ route('dashboard', ['seccion' => 'pagina', 'opcion' => 'seccion-form', 'id' => Crypt::encryptString($s->idSeccion)]) }}?pagina={{ $nombrePagina }}" 
                   class="btn btn-sm btn-gradient-primary">
                  <i class="bi bi-pencil"></i>
                </a>
                <form method="POST" action="{{ route('dashboard', ['seccion' => 'pagina', 'opcion' => 'eliminar-seccion']) }}" style="display: inline;">
                  @csrf
                  <input type="hidden" name="pagina" value="{{ $nombrePagina }}">
                  <input type="hidden" name="id" value="{{ Crypt::encryptString($s->idSeccion) }}">
                  <button type="submit" class="btn btn-sm btn-gradient-danger" onclick="return confirm('¿Eliminar esta sección?')">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <div class="alert alert-info">
        <i class="bi bi-info-circle me-2"></i>
        No hay secciones configuradas para esta página.
      </div>
    @endif
  </div>
</div>
@endsection

