@extends('layouts.app')

@section('title','Verificar correo')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body p-5">

                    <h2 class="text-center text-success-custom mb-3">
                        🌿 EcoTech
                    </h2>

                    <p class="text-center text-muted mb-4">
                        ¡Gracias por registrarte!
                    </p>

                    <p class="text-center">
                        Antes de continuar, verifica tu dirección de correo electrónico haciendo clic en el enlace que te enviamos.
                        Si no recibiste el correo, puedes solicitar uno nuevo.
                    </p>

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success mt-4">
                            Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <button type="submit" class="btn btn-success-custom w-100 mb-3">
                            Reenviar correo de verificación
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="btn btn-outline-secondary w-100">
                            Cerrar sesión
                        </button>
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection