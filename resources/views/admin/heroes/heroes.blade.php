@extends('admin.layout.app')

@section('title')
<h3 class="mb-0">Heroes</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active" aria-current="page">Heroes</li>
@endsection

@section('content')
<style>
  .table-modern {
    border-radius: 1rem;
    overflow: hidden;
    background: #ffffff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
  }

  .table-modern thead tr {
    background: linear-gradient(90deg, #0d6efd, #00b894);
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    font-size: 0.85rem;
  }

  .table-modern td {
    font-size: 0.9rem;
    color: #212529;
    vertical-align: middle;
    padding: 0.9rem;
  }

  .table-modern tbody tr {
    transition: all 0.25s ease;
  }

  .table-modern tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.08);
    transform: scale(1.01);
  }

  .btn-gradient-primary {
    background: linear-gradient(90deg, #0d6efd, #00b894);
    color: #fff;
    border: none;
    border-radius: 2rem;
    transition: 0.3s ease;
  }

  .btn-gradient-primary:hover {
    transform: scale(1.1);
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
    transform: scale(1.1);
    box-shadow: 0 0 12px rgba(255, 107, 129, 0.5);
  }

  .img-heroe {
    max-width: 150px;
    max-height: 100px;
    object-fit: cover;
    border-radius: 0.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }
</style>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
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

          <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h4 class="card-title"><strong>Administración de Heroes</strong></h4>
              <p class="card-title-desc mb-0">
                Gestiona las secciones hero (banners principales) de cada página del sitio web.
              </p>
            </div>
            <a href="{{ route('dashboard', ['seccion' => 'heroes', 'opcion' => 'form']) }}" 
               class="btn btn-gradient-primary">
              <i class="bi bi-plus-circle me-1"></i> Crear Hero
            </a>
          </div>

          @if($heroes->isEmpty())
            <div class="alert alert-warning">
              <i class="bi bi-exclamation-triangle me-2"></i>
              No hay heroes registrados.
            </div>
          @else
            <div class="table-responsive">
              <table class="table table-hover align-middle text-center table-modern">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Página</th>
                    <th>Título</th>
                    <th>Subtítulo</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($heroes as $h)
                  <tr>
                    <td><strong>{{ $h->idHeroe }}</strong></td>
                    <td>
                      @if($h->imagen)
                        <img src="{{ asset($h->imagen) }}" alt="{{ $h->titulo }}" class="img-heroe">
                      @else
                        <span class="text-muted">Sin imagen</span>
                      @endif
                    </td>
                    <td><span class="badge bg-primary">{{ $h->pagina }}</span></td>
                    <td>{{ Str::limit($h->titulo, 40) }}</td>
                    <td>{{ Str::limit($h->subtitulo ?? 'N/A', 50) }}</td>
                    <td class="text-nowrap">
                      <a href="{{ route('dashboard', ['seccion' => 'heroes', 'opcion' => 'form', 'id' => Crypt::encryptString($h->idHeroe)]) }}"
                        class="btn btn-sm btn-gradient-primary me-1"
                        title="Editar hero">
                        <i class="bi bi-pencil-square"></i>
                      </a>
                      <a href="{{ route('eliminarHeroe', ['id' => Crypt::encryptString($h->idHeroe)]) }}"
                        class="btn btn-sm btn-gradient-danger eliminar-heroe"
                        title="Eliminar hero">
                        <i class="bi bi-trash"></i>
                      </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.eliminar-heroe');

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            if (confirm('¿Estás seguro de que quieres eliminar este hero? Esta acción no se puede deshacer.')) {
                window.location.href = this.href;
            }
        });
    });
});
</script>
@endsection

