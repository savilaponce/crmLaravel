@extends('layouts.app')

@section('title', 'Detalle Producto - CRM Laravel')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0"><i class="bi bi-box-seam"></i> Detalle del Producto</h4>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th width="200">ID:</th>
                            <td>{{ $producto->id }}</td>
                        </tr>
                        <tr>
                            <th>Nombre:</th>
                            <td>{{ $producto->nombre }}</td>
                        </tr>
                        <tr>
                            <th>SKU:</th>
                            <td><code>{{ $producto->sku }}</code></td>
                        </tr>
                        <tr>
                            <th>Descripción:</th>
                            <td>{{ $producto->descripcion ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Precio:</th>
                            <td><strong>{{ number_format($producto->precio, 2) }} €</strong></td>
                        </tr>
                        <tr>
                            <th>Stock:</th>
                            <td>
                                <span class="badge {{ $producto->stock > 10 ? 'bg-success' : 'bg-warning' }}">
                                    {{ $producto->stock }} unidades
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha de Registro:</th>
                            <td>{{ $producto->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Última Actualización:</th>
                            <td>{{ $producto->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                    <div>
                        <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form action="{{ route('productos.destroy', $producto) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('¿Está seguro de eliminar este producto?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
