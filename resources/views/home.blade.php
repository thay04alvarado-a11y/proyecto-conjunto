@extends('base')

@section('title', 'Home')

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
<section class="container my-5">
      <h1 class="text-center mb-4 fw-bold text-success">¡Proceso Matrícula!</h1>
      <div class="row justify-content-center align-items-center mb-4 h2 fw-bold">
        <div class="col-4 text-success">
          ¡Iniciamos Matrícula!<br>
          Del 14 de julio al 31 de agosto de 2025. <br>
          III Cuatrimestre<br>
          1 de setiembre 2025<br>
          ¡ETAI es mi casa! <br><br>

          <a class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="https://forms.gle/VFssHN65wbDH99ND7">Inscríbete aquí</a>
        </div>
      
        <div class="col-4">
          <img src="{{asset('assets/img/ventajas.png')}}" alt="ETAI Ventajas" class="img-fluid">
        </div>
      </div>
      <br>
    </section>

    <section class="container my-5 bg-success-subtle p-4 rounded-3">
      <div class="row justify-content-center ">
        <div class="col-4 align-items-center mb-4 h2 fw-bold text-success">
          Educación que transforma vidas
        </div>

        <div class="col-6 text-end mb-4 h4 fw-normal">
          <p>En la ETAI creemos que la educación técnica es la clave para el progreso del país. Nuestros programas están diseñados para brindar a cada estudiante las herramientas necesarias para destacar en un mundo laboral cambiante, con una formación integral basada en la ética, la innovación y la sostenibilidad.</p>
        </div>
      </div>
    </section>

    <section class="container my-5">
      <h1 class="text-center mb-4 fw-bold text-success">¡SEMANA U!</h1>
      <div class="row justify-content-center align-items-center">
        
        <div class="col-4">
          <img src="{{asset('assets/img/SU.jpeg')}}" alt="Semana U" class="img-fluid w-75 rounded-3">
        </div>
        
        <div class="col-4 mb-4 ">

        <p class="h2 fw-bold text-success">¡Viví la Semana U ETAI!</p>
        <p class="h4 fw-normal">La Semana U es el espacio donde celebramos el talento, la creatividad y la unión de toda la comunidad ETAI.</p>
        <p class="h4 fw-normal">Durante esta semana se realizan actividades deportivas, culturales, académicas y recreativas que fortalecen el espíritu universitario.</p> <br>

        <p class="h3 fw-bold text-success">📅 Próxima edición: del 13 al 20 de Octubre de 2026</p>
        </div>
      
      </div>
      <br>
    </section>

    <section class="container my-5 bg-success-subtle p-4 rounded-3">
      <div class="row justify-content-center ">
        
        <div class="col-6 text-start mb-4 h4 fw-normal">

          <p class="text-center mb-4 h2 fw-bold text-success">COMPROMETIDOS CON TU FUTURO</p>
        
          <p>En la ETAI trabajamos día a día para ofrecerte una experiencia educativa de calidad, con docentes capacitados, infraestructura moderna y un ambiente que impulsa el desarrollo profesional y humano.</p>
          <p>Nuestra misión es formar líderes técnicos y éticos, preparados para aportar soluciones reales a los desafíos del país.</p>
        </div>

        

        
      </div>
    </section>
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

@endsection

@section('scripts')
    
@endsection
