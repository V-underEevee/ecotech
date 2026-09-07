@extends('layouts.app')

@section('title', 'Blog de Novedades')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1>Blog de Novedades</h1>
            <p class="lead">Consejos y noticias sobre tecnologia sustentable</p>
        </div>
    </div>

    @if($posts->count() > 0)
        <div class="row">
            @foreach($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card post-card h-100">
                    @if($post->image)
                        @php
                            // IDs de los posts con imagen vertical
                            $verticalPosts = [2, 4]; 
                            $position = in_array($post->id, $verticalPosts) ? 'top' : 'center';
                        @endphp
                        <img src="{{ asset($post->image) }}" class="card-img-top" alt="{{ $post->title }}" 
                             style="height: 200px; object-fit: cover; object-position: {{ $position }}; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    @endif
                    <div class="card-body">
                        <small class="text-muted">
                            <i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse($post->published_date)->format('d/m/Y') }} |
                            <i class="bi bi-person"></i> {{ $post->author }}
                        </small>
                        <h4 class="card-title mt-2">{{ $post->title }}</h4>
                        <p class="card-text">{{ Str::limit($post->excerpt, 100) }}</p>
                        <a href="/blog/{{ $post->slug }}" class="btn btn-outline-success">Leer mas</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Paginacion -->
        <div class="row mt-4">
            <div class="col-12">
                {{ $posts->links() }}
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center">
            <h4>No hay articulos disponibles</h4>
            <p>Pronto agregaremos contenido nuevo.</p>
        </div>
    @endif
</div>
@endsection