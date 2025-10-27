@extends('admin.layout.app')

@section('title')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
 <li class="breadcrumb-item active" aria-current="page">Usuarios form</li> 
@endsection

@section('content')
<style>
    /* 🌈 Tarjeta general */
.form-epico {
  border: none;
  border-radius: 1.2rem;
  box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
  background: #fff;
  transition: all 0.3s ease;
}
.form-epico:hover {
  transform: translateY(-4px);
}

/* 🏷️ Título */
.form-epico .card-title {
  font-weight: 700;
  background: linear-gradient(90deg, #0d6efd, #00b894);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* ✨ Campos de entrada */
.campo-epico {
  border-radius: 0.75rem;
  border: 1.5px solid #dee2e6;
  transition: all 0.3s ease;
  font-size: 0.95rem;
}
.campo-epico:focus {
  border-color: #0d6efd;
  box-shadow: 0 0 8px rgba(13, 110, 253, 0.3);
}

/* 🧭 Etiquetas */
.form-label {
  font-weight: 600;
  color: #2c3e50;
}

/* 🔘 Botones (mismos de la tabla épica) */
.btn-gradient-primary {
  background: linear-gradient(90deg, #0d6efd, #00b894);
  color: #fff;
  border: none;
  border-radius: 2rem;
  padding: 0.6rem 1.4rem;
  font-weight: 600;
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
  padding: 0.6rem 1.4rem;
  font-weight: 600;
  transition: 0.3s ease;
}
.btn-gradient-danger:hover {
  transform: scale(1.05);
  box-shadow: 0 0 12px rgba(255, 107, 129, 0.5);
}
</style>


<div class="card form-epico mt-4">
  <div class="card-body">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Encabezado -->
    <div class="d-flex align-items-center mb-3">
      <i class="bi bi-person-circle me-2 fs-3 text-primary"></i>
      <h4 class="card-title mb-0">Editar Usuario</h4>
    </div>

    <p class="card-title-desc">
      Modifica la información del usuario y guarda los cambios en el sistema.
    </p>

    <form 
        id="form-editar"           
        method="POST"               
        class="form" 
        name="form-editar" 
        autocomplete="off">

        @csrf

      <!-- ID oculto -->
      <input type="hidden" name="idUsuario" id="idUsuario" value="{{ $usuario->idUsuario }}">

      <div class="row g-3 mt-2">
        
        <!-- Nombre -->
        <div class="col-md-6">
          <label for="nombre" class="form-label">Nombre completo</label>
          <input 
            type="text" 
            class="form-control campo-epico" 
            id="nombre" 
            name="nombre" 
            placeholder="Ej. Juan Pérez" 
            value="{{ old('nombre', $usuario->nombre) }}" 
            required>
        </div>

        <!-- Correo -->
        <div class="col-md-6">
          <label for="correo" class="form-label">Correo electrónico</label>
          <input 
            type="email" 
            class="form-control campo-epico" 
            id="correo" 
            name="correo" 
            placeholder="usuario@correo.com" 
            value="{{ old('correo', $usuario->correo) }}" 
            required>
        </div>

        <!-- Contraseña -->
        <div class="col-md-6">
          <label for="contra" class="form-label">Contraseña</label>
          <input 
            type="password" 
            class="form-control campo-epico" 
            id="contra" 
            name="contra" 
            placeholder="Dejar en blanco si no desea cambiarla">
        </div>

        <!-- Estado -->
        <div class="col-md-6">
          <label for="activo" class="form-label">Estado</label>
          <select class="form-select campo-epico" id="activo" name="activo">
            <option value="1" {{ $usuario->activo == 1 ? 'selected' : '' }}>Activo</option>
            <option value="0" {{ $usuario->activo == 0 ? 'selected' : '' }}>Inactivo</option>
          </select>
        </div>

      </div>

      <!-- Botones -->
      <div class="text-center mt-4">
        <button type="submit" class="btn btn-gradient-primary me-2 btnEditar">
          <i class="bi bi-save me-1"></i> Guardar Cambios
        </button>

        <a href="" class="btn btn-gradient-danger">
          <i class="bi bi-x-circle me-1"></i> Cancelar
        </a>
      </div>

    </form>
    <div id="mensaje" class="alert alert-success mt-3" style="display:none;"></div>
    <div id="mensaje-error" class="alert alert-danger mt-3" style="display:none;"></div>

  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {

    const form = document.getElementById('form-editar');
    const btnEditar = document.querySelector('.btnEditar'); 
    const msg = document.getElementById('mensaje');
    const msgError = document.getElementById('mensaje-error');

    
    btnEditar.addEventListener('click', (e) => {
        e.preventDefault(); 

        const idUsuario = document.getElementById('idUsuario').value;

        // 🔹 Validaciones antes de enviar
        const nombre = document.getElementById('nombre').value.trim();
        const correo = document.getElementById('correo').value.trim();
        const contra = document.getElementById('contra').value.trim();
        const activo = document.getElementById('activo').value;
        const errores = [];

        const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (nombre === '') {
          errores.push('El nombre es obligatorio.');
        }

        if (!regexCorreo.test(correo)) {
          errores.push('El correo electrónico no es válido.');
        }


        if (activo !== '0' && activo !== '1') {
          errores.push('El estado debe ser Activo o Inactivo.');
        }

        if (errores.length > 0) {
          msgError.innerHTML = '<strong>Error:</strong><br>' + errores.join('<br>');
          msgError.style.display = 'block';
          msg.style.display = 'none';
          return;
        }

        // ✅ Capturar datos del formulario
        const datos = new FormData(form);
        const jsonData = {};
        datos.forEach((value, key) => jsonData[key] = value);

        // ✅ Enviar con fetch (IMPORTANTE: usar backticks)
        fetch(`/actualizar-usuario/${idUsuario}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(jsonData)
        })
        .then(res => res.json())
        .then(data => {
            if (data.ok) {
                msg.textContent = '✅ Usuario actualizado correctamente.';
                msg.style.display = 'block';

                setTimeout(() => {
                    location.reload('/usuarios'); // refresca después de 2 segundos
                }, 2000);
            } else {
                msgError.innerHTML = `<strong>Error:</strong> ${Object.values(data.errors).join(', ')}`;
                msgError.style.display = 'block';
            }
        })
        .catch(error => {
            console.error(error);
            msgError.innerHTML = '<strong>Error:</strong> No se pudo actualizar el usuario.';
            msgError.style.display = 'block';
        });
    });
});
</script>









@endsection