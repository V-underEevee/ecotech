@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-4">
                <a href="{{ route('blog.index') }}" class="btn btn-outline-success">
                    <i class="bi bi-arrow-left"></i> Volver al blog
                </a>
            </div>
            <div class="card">
                <!-- Imagen destacada -->
                @if($post->image)
                    @php
                        // IDs de los posts con imagen vertical
                        $verticalPosts = [2, 4];
                        $position = in_array($post->id, $verticalPosts) ? 'top' : 'center';
                    @endphp
                    <img src="{{ asset($post->image) }}" class="card-img-top" alt="{{ $post->title }}" 
                         style="width: 100%; max-height: 400px; object-fit: cover; object-position: {{ $position }}; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                @endif
                <div class="card-body">
                    <div class="text-muted mb-3">
                        <i class="bi bi-calendar"></i> {{ $post->published_date->format('d/m/Y') }} |
                        <i class="bi bi-person"></i> {{ $post->author }} |
                        <i class="bi bi-eye"></i> {{ $post->views }} vistas
                    </div>
                    <h1 class="card-title mb-4">{{ $post->title }}</h1>
                    <div class="card-text">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection