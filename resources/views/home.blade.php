@extends('base')

@section('title', 'Home')

@section('hero')
    <!-- <section class="hero d-flex flex-column justify-content-center align-items-center homeHero">
      <h1 class="display-4 fw-bold">Bienvenidos a la ETAI</h1>
      <p class="lead">Educación, innovación y sostenibilidad en el corazón verde del conocimiento</p>
    </section> -->
    <div id="carouselExampleCaptions" class="carousel slide">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{ asset('assets/'.$configuracion->home_hero) }}" class="d-block img-fluid" style="height: 500px; width: 100%;" alt="Imagen Hero Home">
          <div class="carousel-caption d-none d-md-block">
            <h1 class="display-4 fw-bold">Bienvenidos a la ETAI</h1>
            <p class="lead fw-bold">Educación, innovación y sostenibilidad en el corazón verde del conocimiento.</p>
          </div>
        </div>
      </div>
    </div>
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
  

@endsection

@section('scripts')
    
@endsection
