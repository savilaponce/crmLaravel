@extends('layouts.app')

@section('title', 'Inventario de Productos')

@section('css')
<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection

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
        
        <div class="card-body">
            <div class="table-responsive">
                <table id="tablaProductos" class="table table-hover align-middle mb-0" style="width:100%">
                    <thead class="bg-light text-uppercase small text-muted">
                        <tr>
                            <th class="border-0">Imagen</th> <th class="ps-4 border-0">Producto / SKU</th>
                            <th class="border-0">Precio</th>
                            <th class="border-0">Stock</th>
                            <th class="border-0">Ficha</th> <th class="border-0 text-end pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                        <tr>
                            <td>
                                @if($producto->imagen)
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                         class="rounded border" 
                                         style="width: 50px; height: 50px; object-fit: cover;" 
                                         alt="Img">
                                @else
                                    <div class="bg-light text-secondary rounded d-flex align-items-center justify-content-center border" 
                                         style="width: 50px; height: 50px;">
                                        <i class="bi bi-camera-video-off"></i>
                                    </div>
                                @endif
                            </td>

                            <td class="ps-4">
                                <a href="{{ route('productos.show', $producto) }}" class="text-dark fw-bold text-decoration-none">
                                    {{ $producto->nombre }}
                                </a>
                                <div class="small text-muted font-monospace">
                                    <i class="bi bi-barcode me-1"></i>{{ $producto->sku }}
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
                                        Agotado
                                    </span>
                                @elseif($producto->stock <= 5)
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill px-3">
                                        Bajo ({{ $producto->stock }})
                                    </span>
                                @else
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3">
                                        Ok ({{ $producto->stock }})
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if($producto->ficha_tecnica)
                                    <a href="{{ asset('storage/' . $producto->ficha_tecnica) }}" target="_blank" class="btn btn-sm btn-outline-danger" title="Ver Ficha Técnica">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                    </a>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
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
                                        
                                        @if(Auth::user()->role === 'admin')
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $producto->id }}">
                                                    <i class="bi bi-trash me-2"></i>Eliminar
                                                </button>
                                            </li>
                                        @endif
                                    </ul>
                                </div>

                                @if(Auth::user()->role === 'admin')
                                    <div class="modal fade text-start" id="deleteModal{{ $producto->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-body text-center p-4">
                                                    <div class="text-danger mb-3"><i class="bi bi-box-arrow-in-down display-4"></i></div>
                                                    <h6 class="fw-bold mb-2">¿Eliminar Producto?</h6>
                                                    <p class="small text-muted">
                                                        Estás a punto de borrar <strong>{{ $producto->nombre }}</strong>.
                                                        <br>Se eliminarán también sus imágenes y archivos asociados.
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
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tablaProductos').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
                },
                "order": [[ 1, "asc" ]], 
                "columnDefs": [
                    { "orderable": false, "targets": [0, 4, 5] } 
                ]
            });
        });
    </script>
@endsection