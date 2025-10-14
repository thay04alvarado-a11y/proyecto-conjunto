<div>
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

 

</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.html">Noticias</a>
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
   
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/img/noticiaoriginal.jpg') }}" class="d-block w-100"  style="height: 500px;" alt="Imagen principal">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section class="hero d-flex flex-column justify-content-center align-items-center h-75">
        <!-- Sección: Lista de noticias -->
        <section class="container my-5">
            <h2 class="mb-4 fw-bold">Últimas Noticias</h2>

            <div class="row g-4">
                @foreach($noticias as $noticia)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100">
                            <img src="{{ asset('assets/img/' . $noticia->imagen) }}" class="card-img-top" alt="{{ $noticia->titulo }}" style="height:200px; object-fit:cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $noticia->titulo }}</h5>
                                <p class="card-text flex-grow-1">{{ $noticia->descripcion_corta }}</p>
                                <!-- Botón que abre el modal -->
                                <button type="button" class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#noticiaModal{{ $noticia->id }}">
                                    Ver más
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
            <div class="modal fade" id="noticiaModal{{ $noticia->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-light">
                            <h5 class="modal-title">{{ $noticia->titulo }}</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ asset('assets/img/' . $noticia->imagen) }}" class="img-fluid mb-3" alt="{{ $noticia->titulo }}">
                            <p>{{ $noticia->descripcion_larga }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
       

    </section>

    <!-- Contenido -->
    <main class="container my-5">
        
        <nav id="navbar-example2" class="navbar bg-body-tertiary px-3 mb-3">
            <a class="navbar-brand" href="#">Menu de Articulos</a>
        </nav>
        <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
  
        <h4>Articulo principal: Innovación tecnológica en 2025</h4>
        <p>La industria tecnológica avanza a pasos agigantados este año, con nuevas herramientas de inteligencia artificial y automatización que prometen cambiar la manera en que trabajamos y vivimos.</p>
        <p>Expertos señalan que las startups que adopten estas tecnologías de forma temprana tendrán una ventaja competitiva significativa. Además, se espera que la inversión en IA crezca un 30% en los próximos dos años.</p>

        <h4>Articulo dos: Cambio climático y políticas verdes</h4>
        <p>Los gobiernos están implementando medidas más estrictas para combatir el cambio climático, incluyendo regulaciones sobre emisiones y fomento de energías renovables.</p>
        <p>Organizaciones ambientales destacan la importancia de la colaboración internacional para reducir la huella de carbono y proteger los ecosistemas más vulnerables.</p>

        <h4>Articulo tres: Economía global y tendencias financieras</h4>
        <p>El mercado global muestra signos de recuperación tras la pandemia, con un crecimiento proyectado del 4% en varios sectores clave.</p>
        <p>Los analistas recomiendan diversificar inversiones y estar atentos a las fluctuaciones de monedas y precios de materias primas.</p>

        <h4>Articulo cuatro: Avances en salud y medicina</h4>
        <p>Los últimos descubrimientos médicos han acelerado tratamientos para enfermedades crónicas y han mejorado la prevención de enfermedades infecciosas.</p>
        <p>La telemedicina sigue expandiéndose, permitiendo que más personas accedan a consultas médicas de calidad desde sus hogares.</p>

        <h4>Articulo cinco: Cultura y entretenimiento en la era digital</h4>
        <p>El streaming y los videojuegos continúan dominando la industria del entretenimiento, mientras que festivales y eventos culturales se adaptan al formato híbrido.</p>
        <p>Los creadores de contenido están explorando nuevas formas de interacción con audiencias, incluyendo experiencias inmersivas y realidad aumentada.</p>

        </div>

    </main>

    <footer>
        <p class="mb-0">&copy; 2025 Universidad Tropical. Todos los derechos reservados.</p>
    </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</div>
