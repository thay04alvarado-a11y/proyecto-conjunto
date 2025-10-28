@extends('base')

@section('title', 'Somos')

@section('hero')
    @if(isset($heroe))
        <div class="bg-light overflow-hidden position-relative" style="min-height: 70vh; display: flex; align-items: center;">
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
        <div class="bg-primary text-white py-5">
            <div class="container text-center py-5">
                <h1 class="display-4 fw-bold">Bienvenidos a la ETAI</h1>
                <p class="lead fs-4">Educación, innovación y sostenibilidad en el corazón verde del conocimiento</p>
            </div>
        </div>
    @endif
@endsection

@section('main')
    @if(isset($secciones) && $secciones->count() > 0)
        @foreach($secciones as $index => $seccion)
            <section class="py-5 {{ $index % 2 == 0 ? 'bg-light' : 'bg-white' }}">
                <div class="container">
                    <div class="row align-items-center g-4">
                        @if($seccion->imagen)
                            <div class="col-md-5 {{ $index % 2 == 1 ? 'order-md-2' : '' }}">
                                <img src="{{ asset($seccion->imagen) }}" alt="{{ $seccion->titulo }}" class="img-fluid rounded shadow">
                            </div>
                            <div class="col-md-7 {{ $index % 2 == 1 ? 'order-md-1' : '' }}">
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
    @else
        <section class="py-5">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="display-5 fw-bold mb-4">Descubre nuestras oportunidades académicas</h2>
                        <p class="lead">Formamos líderes comprometidos con el desarrollo sostenible y la tecnología. Explora nuestras carreras y programas.</p>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- <section class="hero d-flex flex-column justify-content-center align-items-center somosHero">
      <h1 class="display-4 fw-bold">Quiénes Somos</h1>
      <p class="lead">Más de 30 años impulsando la educación técnica y el desarrollo sostenible.</p>
    </section> -->

    <div id="carouselExampleCaptions" class="carousel slide">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{ asset('assets/'.$configuracion->somos_hero) }}" class="d-block img-fluid" style="height: 500px; width: 100%;" alt="Imagen Hero Somos">
          <div class="carousel-caption d-none d-md-block">
            <h1 class="display-4 fw-bold">Quiénes Somos</h1>
            <p class="lead fw-bold">Más de 30 años impulsando la educación técnica y el desarrollo sostenible.</p>
          </div>
        </div>
      </div>
    </div>
@endsection


@section('scripts')
    
@endsection
