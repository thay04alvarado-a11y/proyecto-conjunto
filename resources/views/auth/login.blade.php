<!DOCTYPE html>
<html lang="en">

<style>
  * {
        font-family: "Poppins", sans-serif;
      }

     

      @keyframes gradientBG {
        0% {
          background-position: 0% 50%;
        }
        50% {
          background-position: 100% 50%;
        }
        100% {
          background-position: 0% 50%;
        }
      }

      .login-box {
        background: #ffffff;
        padding: 40px 35px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        width: 380px;
        animation: fadeIn 1s ease;
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      .login-logo a {
        font-size: 32px;
        font-weight: 600;
        color: #2ecc71;
        text-decoration: none;
      }

      .form-control {
        border-radius: 10px;
        padding: 12px;
      }

      .btn-primary {
        background-color: #2ecc71;
        border: none;
        transition: all 0.3s ease;
      }

      .btn-primary:hover {
        background-color: #27ae60;
        transform: scale(1.05);
      }

      .btn-facebook {
        background-color: #3b5998;
        border: none;
        transition: all 0.3s ease;
      }

      .btn-facebook:hover {
        background-color: #324b81;
        transform: scale(1.05);
      }

      .btn-google {
        background-color: #db4437;
        border: none;
        transition: all 0.3s ease;
      }

      .btn-google:hover {
        background-color: #c1351d;
        transform: scale(1.05);
      }

      a {
        color: #2ecc71;
        text-decoration: none;
      }

      a:hover {
        text-decoration: underline;
      }

      .login-box-msg {
        color: #555;
        font-size: 15px;
        margin-bottom: 25px;
      }

      .input-group-text {
        background-color: #f1f1f1;
        border: none;
      }

      .card {
        border: none;
        background: transparent;
      }

</style>
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
        <a href="#"><b>Iniciar sesión</b></a>
      </div>

      <p class="login-box-msg">Inicia sesión para continuar</p>

     <form id="form-login">
      <!-- Campo de correo -->
      <div class="input-group mb-3">
        <input
          type="email"
          id="correo"
          name="correo"
          class="form-control"
          placeholder="Correo electrónico"
          value="admin@gmail.com"
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
          value="Diosteama.1"
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
      </div>

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
