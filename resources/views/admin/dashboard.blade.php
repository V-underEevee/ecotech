@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <h4 class="mb-3">Panel de Control</h4>
        <p class="text-muted">Estadisticas generales del sistema</p>
    </div>
</div>

<!-- Tarjetas de estadisticas -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-people"></i> Usuarios</h5>
                <h2 class="mb-0">{{ $totalUsers }}</h2>
                <small>Registrados en el sistema</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-box-seam"></i> Servicios</h5>
                <h2 class="mb-0">{{ $totalServices }}</h2>
                <small>Contratados en total</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-newspaper"></i> Posts</h5>
                <h2 class="mb-0">{{ $totalPosts }}</h2>
                <small>Publicados en el blog</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-box"></i> Productos</h5>
                <h2 class="mb-0">{{ $totalProducts }}</h2>
                <small>En el catalogo</small>
            </div>
        </div>
    </div>
</div>

<!-- Estadisticas detalladas -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-trophy"></i> Servicio mas contratado</h5>
            </div>
            <div class="card-body">
                @if($mostPopularService)
                    <h3>{{ $mostPopularService->service_name }}</h3>
                    <p class="text-muted">{{ $mostPopularService->total }} contrataciones</p>
                @else
                    <p class="text-muted">No hay servicios contratados aun</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-star"></i> Usuario con mas servicios</h5>
            </div>
            <div class="card-body">
                @if($topUser && $topUser->services_count > 0)
                    <h3>{{ $topUser->name }}</h3>
                    <p class="text-muted">{{ $topUser->services_count }} servicios contratados</p>
                @else
                    <p class="text-muted">No hay usuarios con servicios</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Servicios por estado -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-pie-chart"></i> Estado de servicios</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="p-3 bg-success bg-opacity-10 rounded">
                            <h3 class="text-success">{{ $activeServices }}</h3>
                            <small>Activos</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-danger bg-opacity-10 rounded">
                            <h3 class="text-danger">{{ $cancelledServices }}</h3>
                            <small>Cancelados</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Ultimos servicios</h5>
            </div>
            <div class="card-body">
                @if($recentServices->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($recentServices as $service)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $service->service_name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $service->user->name ?? 'Usuario' }}</small>
                                </div>
                                <span class="badge {{ $service->status === 'activo' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $service->status }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No hay servicios recientes</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection