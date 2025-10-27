@extends('base')

@section('title', 'Noticias')

@section('hero')
    @if(isset($heroe))
        <div class="bg-light overflow-hidden position-relative" style="min-height: 60vh; display: flex; align-items: center;">
            <div class="position-absolute w-100 h-100" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.3)), url('{{ $heroe->imagen ? asset($heroe->imagen) : '' }}'); background-size: cover; background-position: center;"></div>
            <div class="container position-relative py-5">
                <div class="row justify-content-center text-center text-white">
                    <div class="col-lg-8">
                        <h1 class="display-3 fw-bold mb-4">{{ $heroe->titulo }}</h1>
                        @if($heroe->subtitulo)
                            <p class="lead fs-4">{{ $heroe->subtitulo }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-primary text-white py-4">
            <div class="container text-center py-4">
                <h1 class="display-5 fw-bold mb-2">Últimas Noticias</h1>
            </div>
        </div>
    @endif
@endsection

@section('main')
    <!-- Sección: Lista de noticias -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="display-5 fw-bold mb-3">Últimas Noticias</h2>
                </div>
            </div>

            <div class="row g-4">
                @foreach($noticias as $noticia)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            @if($noticia->imagen)
                                <img src="{{ asset($noticia->imagen) }}" class="card-img-top" alt="{{ $noticia->titulo }}" style="height:220px; object-fit:cover;">
                            @else
                                <img src="{{ asset('assets/img/noticiaoriginal.jpg') }}" class="card-img-top" alt="Imagen por defecto" style="height:220px; object-fit:cover;">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold mb-3">{{ $noticia->titulo }}</h5>
                                <p class="card-text text-muted flex-grow-1 mb-3">{{ Str::limit($noticia->descripcion_corta, 100) }}</p>
                                <a href="{{ route('noticias.ver', $noticia->idNoticia) }}" class="btn btn-primary mt-auto">Ver más</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if(isset($secciones) && $secciones->count() > 0)
        @foreach($secciones as $seccion)
            <section class="py-5 {{ $loop->even ? 'bg-light' : 'bg-white' }}">
                <div class="container">
                    <div class="row align-items-center g-4">
                        @if($seccion->imagen)
                            <div class="col-md-5 {{ $loop->even ? 'order-md-2' : '' }}">
                                <img src="{{ asset($seccion->imagen) }}" alt="{{ $seccion->titulo }}" class="img-fluid rounded shadow">
                            </div>
                            <div class="col-md-7 {{ $loop->even ? 'order-md-1' : '' }}">
                                <h2 class="fw-bold mb-3">{{ $seccion->titulo }}</h2>
                                @if($seccion->parrafo)
                                    <p class="lead">{{ $seccion->parrafo }}</p>
                                @endif
                            </div>
                        @else
                            <div class="col-12 text-center">
                                <h2 class="fw-bold mb-3">{{ $seccion->titulo }}</h2>
                                @if($seccion->parrafo)
                                    <p class="lead">{{ $seccion->parrafo }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endforeach
    @endif

    <main class="container my-5 py-4">
        
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