@extends('admin.layouts.app')

@section('title', 'Detalles del Usuario')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-0">{{ $user->name }}</h4>
        <p class="text-muted">Detalles del usuario y sus servicios contratados</p>
    </div>
    <a href="{{ route('admin.users') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5>Informacion del Usuario</h5>
                <table class="table table-sm">
                    <tr>
                        <th>ID</th>
                        <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Rol</th>
                        <td>
                            <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-primary' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Registro</th>
                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-box-seam"></i> Servicios Contratados</h5>
            </div>
            <div class="card-body">
                @if($user->services->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Servicio</th>
                                    <th>Precio</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->services as $service)
                                <tr>
                                    <td>{{ $service->service_name }}</td>
                                    <td>${{ number_format($service->price, 2) }}</td>
                                    <td>{{ $service->contract_date->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge {{ $service->status === 'activo' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $service->status }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        <strong>Total:</strong> {{ $user->services->count() }} servicios
                    </div>
                @else
                    <p class="text-muted text-center">Este usuario no tiene servicios contratados.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection