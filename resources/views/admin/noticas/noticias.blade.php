@extends('admin.layout.app')

@section('title')
<h3 class="mb-0">Noticias</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active" aria-current="page">Noticias</li>
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

  .img-noticia {
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
              <h4 class="card-title"><strong>Administración de Noticias</strong></h4>
              <p class="card-title-desc mb-0">
                Gestiona las noticias del sitio web, crea, edita y elimina contenido de forma rápida y eficiente.
              </p>
            </div>
            <a href="{{ route('dashboard', ['seccion' => 'noticias', 'opcion' => 'form']) }}" 
               class="btn btn-gradient-primary">
              <i class="bi bi-plus-circle me-1"></i> Crear Noticia
            </a>
          </div>

          @if($noticias->isEmpty())
            <div class="alert alert-warning">
              <i class="bi bi-exclamation-triangle me-2"></i>
              No hay noticias registradas.
            </div>
          @else
            <div class="table-responsive">
              <table class="table table-hover align-middle text-center table-modern">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Título</th>
                    <th>Descripción Corta</th>
                    <th>Autor</th>
                    <th>Fecha</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($noticias as $n)
                  <tr>
                    <td><strong>{{ $n->idNoticia }}</strong></td>
                    <td>
                      @if($n->imagen)
                        <img src="{{ asset($n->imagen) }}" alt="{{ $n->titulo }}" class="img-noticia">
                      @else
                        <span class="text-muted">Sin imagen</span>
                      @endif
                    </td>
                    <td>{{ Str::limit($n->titulo, 50) }}</td>
                    <td>{{ Str::limit($n->descripcion_corta ?? 'N/A', 60) }}</td>
                    <td>{{ $n->autor ?? 'N/A' }}</td>
                    <td>{{ $n->fecha ? date('d/m/Y', strtotime($n->fecha)) : 'N/A' }}</td>
                    <td>
                      @if($n->categorias && $n->categorias->count() > 0)
                        @foreach($n->categorias as $cat)
                          <span class="badge bg-info">{{ $cat->nombre }}</span>
                        @endforeach
                      @else
                        <span class="text-muted">Sin categorías</span>
                      @endif
                    </td>
                    <td class="text-nowrap">
                      <a href="{{ route('dashboard', ['seccion' => 'noticias', 'opcion' => 'form', 'id' => Crypt::encryptString($n->idNoticia)]) }}"
                        class="btn btn-sm btn-gradient-primary me-1"
                        title="Editar noticia">
                        <i class="bi bi-pencil-square"></i>
                      </a>
                      <a href="{{ route('eliminarNoticia', ['id' => Crypt::encryptString($n->idNoticia)]) }}"
                        class="btn btn-sm btn-gradient-danger eliminar-noticia"
                        title="Eliminar noticia">
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
    const deleteButtons = document.querySelectorAll('.eliminar-noticia');

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            if (confirm('¿Estás seguro de que quieres eliminar esta noticia? Esta acción no se puede deshacer.')) {
                window.location.href = this.href;
            }
        });
    });
});
</script>
@endsection
