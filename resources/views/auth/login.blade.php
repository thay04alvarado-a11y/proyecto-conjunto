<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <title>Login Page</title>
    <link rel="stylesheet" href="css/adminlte.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
      rel="stylesheet"
    />

    <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />

    <!-- Bootstrap 5 -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
      crossorigin="anonymous"
    />

  
  </head>

  <body>
    <div class="login-box text-center">
      <div class="login-logo mb-3">
        <a href="#"><b>Login</b></a>
      </div>

      <p class="login-box-msg">Sign in to start your session</p>

     <form id="form-login">
      <!-- Campo de correo -->
      <div class="input-group mb-3">
        <input
          type="email"
          id="correo"
          name="correo"
          class="form-control"
          placeholder="Correo electrónico"
          value="keylorfrancisco123@gmail.com"
          required
          autocomplete="email"
        />
        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
      </div>

      <!-- Campo de contraseña -->
      <div class="input-group mb-3">
        <input
          type="password"
          id="contra"
          name="contra"
          class="form-control"
          placeholder="Contraseña"
          value="Knlm1234567."
          required
          autocomplete="current-password"
        />
        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
      </div>

      <!-- Recordarme y botón -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="form-check">
          <input
            class="form-check-input"
            type="checkbox"
            id="remember"
            name="remember"
          />
          <label class="form-check-label" for="remember">Recordarme</label>
        </div>
        <button type="submit" class="btn btn-primary px-4">Iniciar sesión</button>
      </div>
    </form>


      <div class="d-grid gap-2 mb-3">
        <a href="#" class="btn btn-facebook">
          <i class="bi bi-facebook me-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-google">
          <i class="bi bi-google me-2"></i> Sign in using Google
        </a>
      </div>

      <p><a href="#">I forgot my password</a></p>
      <p class="mb-0">
        <a href="#" class="text-center">Register a new membership</a>
      </p>
    </div>

    <!-- Scripts -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
  </body>
  <script>
  document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const emailInput = form.querySelector('input[type="email"]');
    const passInput = form.querySelector('input[type="password"]');

    // ✅ Validaciones con expresiones regulares
    const validarCorreo = (correo) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo);
    const validarContra = (contra) => /^(?=.*[A-Z])(?=.*\d).{8,}$/.test(contra);

    form.addEventListener("submit", (e) => {
      e.preventDefault(); 
      let valido = true;
      let mensaje = "";

      // Validar correo
      if (emailInput.value.trim() === "") {
        valido = false;
        mensaje = "El correo es obligatorio.";
      } else if (!validarCorreo(emailInput.value.trim())) {
        valido = false;
        mensaje = "Ingresa un correo electrónico válido.";
      }

      // Validar contraseña
      if (valido && passInput.value.trim() === "") {
        valido = false;
        mensaje = "La contraseña es obligatoria.";
      } else if (valido && !validarContra(passInput.value.trim())) {
        valido = false;
        mensaje =
          "La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.";
      }

      if (!valido) {
        Swal.fire({
          icon: "warning",
          title: "Validación",
          text: mensaje,
          confirmButtonColor: "#3085d6",
        });
        return;
      }

      // ✅ Preparar datos del formulario
      const datos = new FormData(form);

      // ✅ Enviar al backend con POST
      fetch("/loginConfirmacion", {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
        },
        body: datos,
      })
        .then((data) => {
          if (data.ok) {
            Swal.fire({
              icon: "success",
              title: "Éxito",
              text: data.mensaje || "Inicio de sesión exitoso.",
              showConfirmButton: false,
              timer: 2000,
            }).then(() => {
              // ✅ Redirigir a dashboard en lugar de recargar
              window.location.href = "/";
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error de acceso",
              text: data.mensaje || "Credenciales incorrectas.",
              confirmButtonColor: "#d33",
            });
          }
        })
        .catch((error) => {
          Swal.fire({
            icon: "error",
            title: "Error de servidor",
            text: "Ocurrió un problema al procesar la solicitud.",
            confirmButtonColor: "#d33",
          });
          console.error("Error en fetch:", error);
        });
    });
  });
</script>




</html>
