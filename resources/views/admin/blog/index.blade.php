@extends('admin.layouts.app')

@section('title', 'Gestionar Blog')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-0">Gestionar Blog</h4>
        <p class="text-muted">Administrá las entradas del blog</p>
    </div>
    <a href="{{ route('admin.blog.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Nueva entrada
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td>
                            @if($blog->image)
                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->author }}</td>
                        <td>{{ $blog->published_date->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge {{ $blog->is_published ? 'bg-success' : 'bg-warning' }}">
                                {{ $blog->is_published ? 'Publicado' : 'Borrador' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="btn btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="{{ route('admin.blog.edit', $blog) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.blog.destroy', $blog) }}" method="POST" 
                                      onsubmit="return confirm('¿Estás seguro de eliminar esta entrada?')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-file-earmark-text fs-4 d-block mb-2"></i>
                            No hay entradas en el blog
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection