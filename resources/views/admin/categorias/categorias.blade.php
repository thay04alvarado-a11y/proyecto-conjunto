@extends('admin.layout.app')

@section('title')
<h3 class="mb-0">Categorías</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active" aria-current="page">Categorías</li>
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

  .badge-activo {
    padding: 0.4rem 0.8rem;
    border-radius: 2rem;
    font-weight: 600;
    font-size: 0.8rem;
    color: #fff;
    display: inline-block;
    min-width: 80px;
    background: linear-gradient(90deg, #00b894, #00cec9);
    box-shadow: 0 0 10px rgba(0, 184, 148, 0.5);
  }

  .badge-inactivo {
    padding: 0.4rem 0.8rem;
    border-radius: 2rem;
    font-weight: 600;
    font-size: 0.8rem;
    color: #fff;
    display: inline-block;
    min-width: 80px;
    background: linear-gradient(90deg, #636e72, #2d3436);
    box-shadow: 0 0 10px rgba(99, 110, 114, 0.3);
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
              <h4 class="card-title"><strong>Administración de Categorías</strong></h4>
              <p class="card-title-desc mb-0">
                Gestiona las categorías para organizar tus noticias. Crea, edita y elimina categorías de forma eficiente.
              </p>
            </div>
            <a href="{{ route('dashboard', ['seccion' => 'categorias', 'opcion' => 'form']) }}" 
               class="btn btn-gradient-primary">
              <i class="bi bi-plus-circle me-1"></i> Crear Categoría
            </a>
          </div>

          @if($categorias->isEmpty())
            <div class="alert alert-warning">
              <i class="bi bi-exclamation-triangle me-2"></i>
              No hay categorías registradas.
            </div>
          @else
            <div class="table-responsive">
              <table class="table table-hover align-middle text-center table-modern">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($categorias as $cat)
                  <tr>
                    <td><strong>{{ $cat->idCategoria }}</strong></td>
                    <td>{{ $cat->nombre }}</td>
                    <td>{{ Str::limit($cat->descripcion, 80) }}</td>
                    <td>
                      <span class="badge {{ $cat->activo ? 'badge-activo' : 'badge-inactivo' }}">
                        {{ $cat->activo ? 'Activo' : 'Inactivo' }}
                      </span>
                    </td>
                    <td class="text-nowrap">
                      <a href="{{ route('dashboard', ['seccion' => 'categorias', 'opcion' => 'form', 'id' => Crypt::encryptString($cat->idCategoria)]) }}"
                        class="btn btn-sm btn-gradient-primary me-1"
                        title="Editar categoría">
                        <i class="bi bi-pencil-square"></i>
                      </a>
                      <a href="{{ route('eliminarCategoria', ['id' => Crypt::encryptString($cat->idCategoria)]) }}"
                        class="btn btn-sm btn-gradient-danger eliminar-categoria"
                        title="Eliminar categoría">
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
    const deleteButtons = document.querySelectorAll('.eliminar-categoria');

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            if (confirm('¿Estás seguro de que quieres eliminar esta categoría? Esta acción no se puede deshacer.')) {
                window.location.href = this.href;
            }
        });
    });
});
</script>
@endsection

