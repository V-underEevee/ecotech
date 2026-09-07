@extends('layouts.app')

@section('title','Iniciar sesión')

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
Inicia sesión para continuar
</p>

<form method="POST" action="{{ route('login') }}">
@csrf

<div class="mb-3">
<label class="form-label">Correo electrónico</label>

<input
type="email"
name="email"
class="form-control"
required>
</div>

<div class="mb-4">
<label class="form-label">Contraseña</label>

<input
type="password"
name="password"
class="form-control"
required>
</div>

<button class="btn btn-success-custom w-100">
Iniciar sesión
</button>

<div class="text-center mt-3">
¿No tienes cuenta?

<a href="{{ route('register') }}">
Regístrate aquí
</a>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

@endsection
