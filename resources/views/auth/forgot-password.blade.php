@extends('layouts.app')

@section('title','Recuperar contraseña')

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
                        ¿Olvidaste tu contraseña? Ingresa tu correo electrónico y te enviaremos un enlace para restablecerla.
                    </p>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label">
                                Correo electrónico
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                required
                                autofocus>

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button class="btn btn-success-custom w-100">
                            Enviar enlace de recuperación
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