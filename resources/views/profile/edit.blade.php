@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Tarjeta de información del usuario -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-person-circle" style="font-size: 80px; color: #2d6a4f;"></i>
                    <h5 class="mt-3">{{ Auth::user()->name }}</h5>
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                    <span class="badge bg-{{ Auth::user()->role === 'admin' ? 'danger' : 'primary' }}">
                        {{ Auth::user()->role }}
                    </span>
                    <hr>
                    <small class="text-muted">Miembro desde: {{ Auth::user()->created_at->format('d/m/Y') }}</small>
                </div>
            </div>
        </div>

        <!-- Formulario de edición -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Editar Perfil</h5>
                </div>
                <div class="card-body">
                    @if(session('status') == 'profile-updated')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i> Perfil actualizado correctamente
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csr
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Guardar cambios
                        </button>
                    </form>

                    <hr>

<!-- Servicios Contratados -->
<h5 class="mt-4"><i class="bi bi-box-seam"></i> Servicios Contratados</h5>
@if(Auth::user()->services && Auth::user()->services->count() > 0)
    <div class="table-responsive">
        <table class="table table-sm table-hover">
            <thead class="table-light">
                <tr>
                    <th>Servicio</th>
                    <th>Precio</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach(Auth::user()->services as $service)
                <tr>
                    <td>{{ $service->service_name }}</td>
                    <td>${{ number_format($service->price, 2) }}</td>
                    <td>{{ $service->contract_date->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge {{ $service->status === 'activo' ? 'bg-success' : 'bg-danger' }}">
                            {{ $service->status === 'activo' ? 'Activo' : 'Cancelado' }}
                        </span>
                    </td>
                    <td>
                        @if($service->status === 'activo')
                            <div class="btn-group btn-group-sm">
                        
                                <form action="{{ route('services.cancel', $service->id) }}" method="POST" 
                                      onsubmit="return confirm('¿Estás seguro de cancelar este servicio?')" class="d-inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-x-circle"></i> Cancelar
                                    </button>
                                </form>
                            </div>
                        @else
                            <span class="text-muted">Cancelado</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> No tenés servicios contratados aún.
        <a href="{{ route('services.index') }}" class="alert-link">Ver planes disponibles</a>
    </div>
@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection