@extends('base')

@section('title', 'Home')

@section('hero')
    @if(isset($heroe))
        <div class="hero" style="background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ $heroe->imagen ? asset($heroe->imagen) : '' }}'); background-size: cover; background-position: center; min-height: 400px;" class="d-flex flex-column justify-content-center align-items-center text-white text-center">
            <h1 class="display-4 fw-bold">{{ $heroe->titulo }}</h1>
            @if($heroe->subtitulo)
                <p class="lead">{{ $heroe->subtitulo }}</p>
            @endif
        </div>
    @else
        <section class="hero d-flex flex-column justify-content-center align-items-center">
            <h1 class="display-4 fw-bold">Bienvenidos a la ETAI</h1>
            <p class="lead">Educación, innovación y sostenibilidad en el corazón verde del conocimiento</p>
        </section>
    @endif
@endsection

@section('main')
    @if(isset($secciones) && $secciones->count() > 0)
        @foreach($secciones as $seccion)
            <section class="container my-5">
                @if($seccion->imagen)
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <img src="{{ asset($seccion->imagen) }}" alt="{{ $seccion->titulo }}" class="img-fluid rounded">
                        </div>
                        <div class="col-md-8">
                            <h2 class="fw-bold">{{ $seccion->titulo }}</h2>
                            @if($seccion->parrafo)
                                <p>{{ $seccion->parrafo }}</p>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="text-center">
                        <h2 class="fw-bold mb-4">{{ $seccion->titulo }}</h2>
                        @if($seccion->parrafo)
                            <p>{{ $seccion->parrafo }}</p>
                        @endif
                    </div>
                @endif
            </section>
        @endforeach
    @else
        <div class="text-center">
            <h2 class="fw-bold mb-4">Descubre nuestras oportunidades académicas</h2>
            <p>Formamos líderes comprometidos con el desarrollo sostenible y la tecnología. Explora nuestras carreras y programas.</p>
        </div>
    @endif
@endsection

@section('scripts')
    
@endsection
