
document.addEventListener("DOMContentLoaded", () => {
  // Obtener el formulario
  const form = document.querySelector("form");
  const emailInput = form.querySelector('input[type="email"]');
  const passInput = form.querySelector('input[type="password"]');

  // Crear contenedores para mensajes de error
  const emailError = document.createElement("small");
  const passError = document.createElement("small");

  emailError.style.color = "red";
  passError.style.color = "red";
  emailError.style.display = "none";
  passError.style.display = "none";

  emailInput.parentNode.after(emailError);
  passInput.parentNode.after(passError);

  // Validar formato de correo
  const validarCorreo = (correo) => {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(correo);
  };

  // Validar contraseña (mínimo 8 caracteres, al menos una mayúscula y un número)
  const validarContra = (contra) => {
    const regex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
    return regex.test(contra);
  };

  form.addEventListener("submit", (e) => {
    e.preventDefault(); // Evita enviar el formulario si hay errores
    let valido = true;

    // Validar email
    if (emailInput.value.trim() === "") {
      emailError.textContent = "⚠️ El correo es obligatorio.";
      emailError.style.display = "block";
      valido = false;
    } else if (!validarCorreo(emailInput.value.trim())) {
      emailError.textContent = "❌ Ingresa un correo electrónico válido.";
      emailError.style.display = "block";
      valido = false;
    } else {
      emailError.style.display = "none";
    }

    // Validar contraseña
    if (passInput.value.trim() === "") {
      passError.textContent = "⚠️ La contraseña es obligatoria.";
      passError.style.display = "block";
      valido = false;
    } else if (!validarContra(passInput.value.trim())) {
      passError.textContent =
        "❌ La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.";
      passError.style.display = "block";
      valido = false;
    } else {
      passError.style.display = "none";
    }

    // Si todo está correcto
    if (valido) {
      // Aquí puedes hacer fetch() o enviar el formulario normalmente
      console.log("Formulario válido:");
      console.log("Correo:", emailInput.value);
      console.log("Contraseña:", passInput.value);

      // Ejemplo: enviar los datos (simulado)
      alert("✅ Login exitoso (validación cliente pasada)");
      form.reset();
    }
  });
});





