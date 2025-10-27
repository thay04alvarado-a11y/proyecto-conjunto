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
      <h4 class="card-title mb-0">Registro de Usuario</h4>
    </div>

    <p class="card-title-desc">
      Completa la información para crear o actualizar un usuario en el sistema.
    </p>


    <form action="" method="POST" class="form" name="form" autocomplete="off">
      <div class="row g-3 mt-2">
        
        <div class="col-md-6">
          <label for="nombre" class="form-label">Nombre completo</label>
          <input 
            type="text" 
            class="form-control campo-epico" 
            id="nombre" 
            name="nombre" 
            placeholder="Ej. Juan Pérez" 
            required>
        </div>

        <div class="col-md-6">
          <label for="correo" class="form-label">Correo electrónico</label>
          <input 
            type="email" 
            class="form-control campo-epico" 
            id="correo" 
            name="correo" 
            placeholder="usuario@correo.com" 
            required>
        </div>

        <div class="col-md-6">
          <label for="contra" class="form-label">Contraseña</label>
          <input 
            type="password" 
            class="form-control campo-epico" 
            id="contra" 
            name="contra" 
            placeholder="Mínimo 8 caracteres" 
            required>
        </div>

        <div class="col-md-6">
          <label for="activo" class="form-label">Estado</label>
          <select class="form-select campo-epico" id="activo" name="activo">
            <option value="1" selected>Activo</option>
            <option value="0">Inactivo</option>
          </select>
        </div>

      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-gradient-primary me-2 btnGuardar">
          <i class="bi bi-save me-1"></i> Guardar Usuario
        </button>
        <button type="reset" class="btn btn-gradient-danger">
          <i class="bi bi-x-circle me-1"></i> Cancelar
        </button>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");
  const btnGuardar = document.querySelector(".btnGuardar");

  btnGuardar.addEventListener("click", async (e) => {
    e.preventDefault();

    limpiarErrores();

    // Obtener valores
    const nombre = form.nombre.value.trim();
    const correo = form.correo.value.trim();
    const contra = form.contra.value.trim();
    const activo = form.activo.value;

    let valido = true;

    // ✅ Validar nombre
    if (nombre.length < 3) {
      marcarError(form.nombre, "El nombre debe tener al menos 3 caracteres.");
      valido = false;
    }

    // ✅ Validar correo
    const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regexCorreo.test(correo)) {
      marcarError(form.correo, "El correo electrónico no es válido.");
      valido = false;
    }

    // ✅ Validar contraseña
    const regexContra = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
    if (!regexContra.test(contra)) {
      marcarError(
        form.contra,
        "La contraseña debe tener al menos 8 caracteres, una mayúscula y un número."
      );
      valido = false;
    }

    // 🚫 Si algo falla, no se envía
    if (!valido) {
      mostrarAlerta("⚠️ Por favor corrige los campos marcados.", "warning");
      return;
    }

    // ✅ Preparar FormData (como en tus productos)
    const datos = new FormData(form);

    try {
      const respuesta = await fetch('/insertarUsuario', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: datos
      });

      const resultado = await respuesta.json();

      if (respuesta.ok && resultado.ok) {
        mostrarAlerta("✅ Usuario guardado correctamente.", "success");
        form.reset();
         setTimeout(() => {
        window.location.href = "/usuarios"; 
    }, 1000);
      } else {
        mostrarAlerta(resultado.mensaje || "❌ Error al guardar el usuario.", "danger");
      }
    } catch (error) {
      console.error("⚠️ Error en la petición:", error);
      mostrarAlerta("Error de conexión o servidor no disponible.", "danger");
    }
  });

  // 🧩 Función para marcar errores
  function marcarError(input, mensaje) {
    input.classList.add("is-invalid");
    const feedback = document.createElement("div");
    feedback.classList.add("invalid-feedback");
    feedback.textContent = mensaje;
    input.parentNode.appendChild(feedback);
  }

  // 🧼 Limpiar errores previos
  function limpiarErrores() {
    form.querySelectorAll(".is-invalid").forEach(el => el.classList.remove("is-invalid"));
    form.querySelectorAll(".invalid-feedback").forEach(el => el.remove());
  }

  // 🧠 Mostrar alerta con Bootstrap
  function mostrarAlerta(mensaje, tipo = "info") {
    const alerta = document.createElement("div");
    alerta.className = `alert alert-${tipo} mt-3`;
    alerta.textContent = mensaje;
    form.insertAdjacentElement("beforebegin", alerta);
    setTimeout(() => alerta.remove(), 4000);
  }
});
</script>



@endsection