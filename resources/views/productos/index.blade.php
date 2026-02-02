@extends('layouts.app')

@section('title', 'Inventario de Productos')

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-dark fw-bold mb-0">Inventario</h1>
            <p class="text-muted small mb-0">Control de stock, precios y catálogo de productos.</p>
        </div>
        <a href="{{ route('productos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Nuevo Producto
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        
        <div class="card-header bg-white py-3">
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control bg-light border-start-0 ps-0" placeholder="Buscar por nombre o SKU...">
                    </div>
                </div>
                <div class="col-md-6 text-md-end text-muted small">
                    Total referencias: <strong>{{ $productos->count() }}</strong>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($productos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-uppercase small text-muted">
                            <tr>
                                <th class="ps-4 py-3 border-0">Producto / SKU</th>
                                <th class="py-3 border-0">Precio Unitario</th>
                                <th class="py-3 border-0">Estado del Stock</th>
                                <th class="py-3 border-0">Última Edición</th>
                                <th class="py-3 border-0 text-end pe-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light text-secondary rounded p-2 me-3 d-flex align-items-center justify-content-center border" style="width: 45px; height: 45px;">
                                            <i class="bi bi-box-seam fs-5"></i>
                                        </div>
                                        <div>
                                            <a href="{{ route('productos.show', $producto) }}" class="text-dark fw-bold text-decoration-none stretched-link-custom">
                                                {{ $producto->nombre }}
                                            </a>
                                            <div class="small text-muted font-monospace">
                                                <i class="bi bi-barcode me-1"></i>{{ $producto->sku }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="fw-bold text-dark fs-6">
                                        {{ number_format($producto->precio, 2) }} €
                                    </div>
                                </td>

                                <td>
                                    @if($producto->stock == 0)
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3">
                                            Agotado (0)
                                        </span>
                                    @elseif($producto->stock <= 5)
                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill px-3">
                                            Bajo Stock ({{ $producto->stock }})
                                        </span>
                                    @else
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3">
                                            En Stock ({{ $producto->stock }})
                                        </span>
                                    @endif
                                </td>

                                <td class="text-muted small">
                                    {{ $producto->updated_at->format('d/m/Y') }}
                                </td>

                                <td class="text-end pe-4">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light text-muted" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('productos.show', $producto) }}">
                                                    <i class="bi bi-eye me-2 text-primary"></i>Ver Detalle
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('productos.edit', $producto) }}">
                                                    <i class="bi bi-pencil me-2 text-warning"></i>Editar
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $producto->id }}">
                                                    <i class="bi bi-trash me-2"></i>Eliminar
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="modal fade text-start" id="deleteModal{{ $producto->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-body text-center p-4">
                                                    <div class="text-danger mb-3"><i class="bi bi-box-arrow-in-down display-4"></i></div>
                                                    <h6 class="fw-bold mb-2">¿Eliminar Producto?</h6>
                                                    <p class="small text-muted">
                                                        Estás a punto de borrar <strong>{{ $producto->nombre }}</strong>.
                                                        <br><span class="fw-bold text-danger">¡Cuidado!</span> Si está en facturas antiguas podría dar error.
                                                    </p>
                                                    <div class="d-flex justify-content-center gap-2 mt-4">
                                                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('productos.destroy', $producto) }}" method="POST">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white py-3">
                    <div class="d-flex justify-content-end">
                        {{ $productos->links() }}
                    </div>
                </div>

            @else
                <div class="text-center py-5">
                    <div class="mb-3 text-muted opacity-25">
                        <i class="bi bi-box-seam display-1"></i>
                    </div>
                    <h4 class="fw-bold">Tu inventario está vacío</h4>
                    <p class="text-muted col-md-6 mx-auto mb-4">
                        Agrega productos para empezar a gestionar tu stock y realizar ventas.
                    </p>
                    <a href="{{ route('productos.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i>Agregar Primer Producto
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection