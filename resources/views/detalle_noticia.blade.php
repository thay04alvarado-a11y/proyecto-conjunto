@extends('base')

@section('title', 'Noticias')

@section('main')
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
      <a class="navbar-brand fw-bold" href="{{ url('/') }}">Noticias</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <main class="container">
    <article class="row g-4">
      <div class="col-12 col-lg-8 mx-auto">
        <h1 class="display-6">{{ $noticia->titulo }}</h1>

        <div class="mb-3 text-muted small">
          <strong>Autor:</strong> {{ $noticia->autor ?? 'Anónimo' }} | 
          <strong>Fecha:</strong> 
          @if($noticia->fecha)
            {{ \Carbon\Carbon::parse($noticia->fecha)->locale('es')->isoFormat('D [de] MMMM, YYYY') }}
          @else
            {{ date('d/m/Y', strtotime($noticia->created_at)) }}
          @endif
          @if($noticia->categorias && $noticia->categorias->count() > 0)
            |
            @foreach($noticia->categorias as $cat)
              <span class="badge bg-info me-1">{{ $cat->nombre }}</span>
            @endforeach
          @endif
        </div>

        @if($noticia->imagen)
          <figure class="mb-4">
            <img src="{{ asset($noticia->imagen) }}" alt="Imagen de {{ $noticia->titulo }}" class="img-fluid shadow-sm rounded">
          </figure>
        @else
          <figure class="mb-4">
            <img src="{{ asset('assets/img/noticiaoriginal.jpg') }}" alt="Imagen por defecto" class="img-fluid shadow-sm rounded">
          </figure>
        @endif

        <section class="mb-5">
          {!! nl2br(e($noticia->descripcion_larga)) !!}
        </section>
      </div>
    </article>
  </main>
@endsection
@section('scripts')
    
@endsection

