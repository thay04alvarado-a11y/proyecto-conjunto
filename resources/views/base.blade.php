<style>
    /* Colores tropicales */
:root {
  --verde-oscuro: #006b3c;
  --verde-claro: #00b875;
  --verde-agua: #a4f4b5;
}

body {
  background-color: #f8fff9;
  font-family: "Poppins", sans-serif;
}

.navbar {
  background: linear-gradient(90deg, var(--verde-oscuro), var(--verde-claro));
}

.navbar-brand, .nav-link {
  color: #ffffff !important;
  font-weight: 500;
  transition: color 0.3s ease, transform 0.3s ease;
}

.nav-link:hover {
  color: var(--verde-agua) !important;
  transform: scale(1.05);
}

.hero {
  background: url("https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1200&q=80")
    center/cover no-repeat;
  color: white;
  text-align: center;
  padding: 120px 20px;
  position: relative;
}

.hero::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 107, 60, 0.6);
}

.hero h1,
.hero p {
  position: relative;
  z-index: 1;
}

footer {
  background-color: var(--verde-oscuro);
  color: #fff;
  text-align: center;
  padding: 15px 0;
  margin-top: 40px;
}

</style>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Universidad Tropical | Inicio</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
 

</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.html">Universidad Tropical</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="noticias.html">Noticias</a></li>
          <li class="nav-item"><a class="nav-link" href="quienes-somos.html">Quiénes Somos</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <section class="hero d-flex flex-column justify-content-center align-items-center">
    <h1 class="display-4 fw-bold">Bienvenidos a la Universidad Tropical</h1>
    <p class="lead">Educación, innovación y sostenibilidad en el corazón verde del conocimiento</p>
  </section>

  <!-- Contenido -->
  <main class="container my-5">
    <div class="text-center">
      <h2 class="fw-bold mb-4">Descubre nuestras oportunidades académicas</h2>
      <p>Formamos líderes comprometidos con el desarrollo sostenible y la tecnología. Explora nuestras carreras y programas.</p>
    </div>
  </main>

  <footer>
    <p class="mb-0">&copy; 2025 Universidad Tropical. Todos los derechos reservados.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

