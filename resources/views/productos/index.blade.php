@extends('layouts.app')

@section('title', 'Productos - CRM Laravel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-box-seam"></i> Gestión de Productos</h2>
    <a href="{{ route('productos.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Nuevo Producto
    </a>
</div>

<div class="card shadow">
    <div class="card-body">
        @if($productos->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>SKU</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td><code>{{ $producto->sku }}</code></td>
                            <td>{{ number_format($producto->precio, 2) }} €</td>
                            <td>
                                <span class="badge {{ $producto->stock > 10 ? 'bg-success' : 'bg-warning' }}">
                                    {{ $producto->stock }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('productos.show', $producto) }}" 
                                       class="btn btn-sm btn-info" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('productos.edit', $producto) }}" 
                                       class="btn btn-sm btn-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('productos.destroy', $producto) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('¿Está seguro de eliminar este producto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $productos->links() }}
            </div>
        @else
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> No hay productos registrados.
                <a href="{{ route('productos.create') }}">Crear el primero</a>
            </div>
        @endif
    </div>
</div>
@endsection
