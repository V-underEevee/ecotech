@extends('layouts.app')

@section('title','Restablecer contraseña')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body p-5">

                    <h2 class="text-center text-success-custom mb-3">
                        🌿 EcoTech
                    </h2>

                    <p class="text-center text-muted mb-4">
                        Ingresa tu nueva contraseña.
                    </p>

                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ request()->route('token') }}">

                        <div class="mb-3">
                            <label class="form-label">
                                Correo electrónico
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', request('email')) }}"
                                required
                                autofocus>

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Nueva contraseña
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                required>

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                Confirmar contraseña
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                required>
                        </div>

                        <button class="btn btn-success-custom w-100">
                            Guardar contraseña
                        </button>

                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}">
                                ← Volver al inicio de sesión
                            </a>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection