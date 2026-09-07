@extends('layouts.app')

@section('title', 'Productos Ecológicos')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1>Nuestros Productos Ecológicos</h1>
            <p class="lead">Tecnología sustentable para cuidar el planeta</p>
        </div>
    </div>

    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <a href="/products/{{ $product->slug }}" class="text-decoration-none">
                <div class="card product-card h-100">
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-success mb-2">{{ $product->category }}</span>
                        <span class="badge bg-info mb-2">{{ $product->eco_feature }}</span>
                        <h4 class="card-title mt-2 text-dark">{{ $product->name }}</h4>
                        <p class="card-text text-muted">{{ Str::limit($product->description, 80) }}</p>
                        <h5 class="text-success">{{ $product->formatted_price }}</h5>
                        <p class="text-muted small">Stock: {{ $product->stock }} unidades</p>
                    </div>
                </div>
            </a>
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