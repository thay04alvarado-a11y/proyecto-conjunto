@extends('admin.layout.app')

@section('title')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
 <li class="breadcrumb-item active" aria-current="page">Usuarios</li> 
@endsection

@section('content')
@extends('admin.layout.app')

@section('title')
Usuarios form
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
 <li class="breadcrumb-item active" aria-current="page">Usuarios form</li> 
 
@endsection

@section('content')
<style>
    /* 🌈 Fondo de tabla con bordes suaves y sombra elegante */
.table-modern {
  border-radius: 1rem;
  overflow: hidden;
  background: #ffffff;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

/* 🌟 Encabezado con degradado dinámico */
.table-modern thead tr {
  background: linear-gradient(90deg, #0d6efd, #00b894);
  color: #fff;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  font-size: 0.85rem;
}

/* 🔹 Celdas y filas */
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

/* 🟢 Badge de estado */
.estado-badge {
  padding: 0.4rem 0.8rem;
  border-radius: 2rem;
  font-weight: 600;
  font-size: 0.8rem;
  color: #fff;
  display: inline-block;
  min-width: 80px;
}
.estado-badge.activo {
  background: linear-gradient(90deg, #00b894, #00cec9);
  box-shadow: 0 0 10px rgba(0, 184, 148, 0.5);
}
.estado-badge.inactivo {
  background: linear-gradient(90deg, #636e72, #2d3436);
  box-shadow: 0 0 10px rgba(99, 110, 114, 0.3);
}

/* 🔘 Botones con degradado */
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

/* 🖋 Iconos */
.btn i {
  font-size: 1rem;
}

</style>
 <div class="row" id="tablePC">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                       <h4 class="card-title"><strong>Administración de Usuarios</strong></h4>
                                       <br>
                                        <p class="card-title-desc">
                                            Controla los usuarios del sistema, asigna roles, verifica su estado activo e implementa acciones de mantenimiento de forma rápida y segura.
                                        </p>

                                        <table id="datatable-buttons" class="table table-hover align-middle text-center table-modern">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre Usuario</th>
                                                    <th>Correo Electrónico</th>
                                                    <th>Estado</th>
                                                    <th colspan="2">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($modelUsuarios as $u)
                                                    <tr>
                                                        <td><strong>{{ $u->idUsuario }}</strong></td>
                                                        <td>{{ $u->nombre }}</td>
                                                        <td>{{ $u->correo }}</td>
                                                        <td>
                                                            <span class="badge estado-badge {{ $u->activo ? 'activo' : 'inactivo' }}">
                                                                {{ $u->activo ? 'Activo' : 'Inactivo' }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('editarUsuario', ['idUsuario' => $u->idUsuario]) }}" 
                                                              class="btn btn-sm btn-gradient-primary" 
                                                              title="Editar usuario">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('eliminarUsuario', $u->idUsuario) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-gradient-danger" title="Eliminar usuario"
                                                                    onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
@endsection
@endsection
