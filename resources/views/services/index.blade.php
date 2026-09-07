@extends('layouts.app')

@section('title', 'Servicios')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1>Nuestros Servicios</h1>
            <p class="lead">Planes sustentables para vos y tu hogar</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        @foreach($services as $service)
        <div class="col-md-4 mb-4">
            <div class="card product-card h-100">
                <img src="{{ $service->image }}" class="card-img-top" alt="{{ $service->name }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <span class="badge bg-success mb-2">{{ $service->category }}</span>
                    <span class="badge bg-info mb-2">{{ $service->eco_feature }}</span>
                    <h4 class="card-title mt-2">{{ $service->name }}</h4>
                    <p class="card-text text-muted">{{ Str::limit($service->description, 80) }}</p>
                    <h5 class="text-success">${{ number_format($service->price, 2) }}</h5>
                    @auth
                        <form action="{{ route('services.subscribe') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-check-circle"></i> Contratar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-success w-100 mt-3">
                            <i class="bi bi-box-arrow-in-right"></i> Iniciar sesión
                        </a>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}
.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}
.card-img-top {
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}
</style>
@endsection