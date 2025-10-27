@extends('base')

@section('title', 'Noticias')

@section('hero')
    @if(isset($heroe))
        <div class="hero" style="background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ $heroe->imagen ? asset($heroe->imagen) : '' }}'); background-size: cover; background-position: center; min-height: 400px;" class="d-flex flex-column justify-content-center align-items-center text-white text-center">
            <h1 class="display-4 fw-bold">{{ $heroe->titulo }}</h1>
            @if($heroe->subtitulo)
                <p class="lead">{{ $heroe->subtitulo }}</p>
            @endif
        </div>
    @else
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/img/noticiaoriginal.jpg') }}" class="d-block w-100" style="height: 300px;" alt="Imagen principal">
                </div>
            </div>
        </div>
    @endif
@endsection

@section('main')

    <section class="hero d-flex flex-column justify-content-center align-items-center h-75">
        <!-- Sección: Lista de noticias -->
        <section class="container my-5">
            <h2 class="mb-4 fw-bold">Últimas Noticias</h2>

            <div class="row g-4">
                @foreach($noticias as $noticia)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100">
                            @if($noticia->imagen)
                                <img src="{{ asset($noticia->imagen) }}" class="card-img-top" alt="{{ $noticia->titulo }}" style="height:200px; object-fit:cover;">
                            @else
                                <img src="{{ asset('assets/img/noticiaoriginal.jpg') }}" class="card-img-top" alt="Imagen por defecto" style="height:200px; object-fit:cover;">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $noticia->titulo }}</h5>
                                <p class="card-text flex-grow-1">{{ Str::limit($noticia->descripcion_corta, 100) }}</p>
                                <!-- Botón que abre el modal -->
                                <a href="{{ route('noticias.ver', $noticia->idNoticia) }}" class="btn btn-primary mt-auto">Ver más</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </section>

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
@endsection

@section('scripts')
    
@endsection