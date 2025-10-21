@extends('base')

@section('title', 'Somos')

@section('hero')
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

@section('main')
    <section class="container my-5">
      <div class="row justify-content-center align-items-center mb-4 h5 fw-bold">
        <div class="col-6 ">
          La Escuela Técnica Agrícola e Industrial (ETAI) nació con la visión de ofrecer una educación técnica de excelencia, enfocada en el desarrollo sostenible, la innovación y el compromiso social. <br>
          Desde nuestros inicios, hemos formado profesionales que contribuyen activamente al crecimiento económico y ambiental de Costa Rica. <br>
          Nuestra filosofía se basa en tres pilares fundamentales: educación de calidad, ética profesional y responsabilidad social. <br>
          Cada programa académico busca no solo preparar técnicos competentes, sino también ciudadanos comprometidos con el bienestar de su comunidad y del país.

        </div>
      
        <div class="col-4">
          <img src="{{asset('assets/img/somos.webp')}}" alt="ETAI Ventajas" class="img-fluid w-100 rounded-3">
        </div>
      </div>
      <br>
    </section>
@endsection

@section('scripts')
    
@endsection
