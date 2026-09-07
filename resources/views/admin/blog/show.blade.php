@extends('admin.layouts.app')

@section('title', 'Ver Entrada')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Ver Entrada</h1>
    <div class="bg-white rounded shadow p-6">
        <p class="text-gray-500">Detalles de la entrada del blog.</p>
        <div class="mt-4">
            <a href="{{ route('admin.blog.index') }}" class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">
                ← Volver al listado
            </a>
        </div>
    </div>
@endsection