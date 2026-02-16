@extends('layouts.app')

@section('title', $producto->nombre . ' - Detalle')

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('productos.index') }}" class="text-decoration-none">Productos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalle</li>
                </ol>
            </nav>
            <h1 class="h3 text-dark fw-bold mb-0">Gestión de Producto</h1>
        </div>
        <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Volver
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h5 class="card-title fw-bold text-dark mb-0"><i class="bi bi-info-circle me-2 text-primary"></i>Información General</h5>
                </div>
                <div class="card-body pt-0">
                    
                    @if($producto->imagen)
                        <div class="mb-4 text-center bg-light rounded p-3">
                            <img src="{{ asset('storage/' . $producto->imagen) }}" class="img-fluid rounded shadow-sm" style="max-height: 400px;" alt="{{ $producto->nombre }}">
                        </div>
                    @endif
                    <div class="mb-4">
                        <label class="text-uppercase text-muted small fw-bold mb-1">Nombre del Producto</label>
                        <h2 class="fs-4 fw-bold text-dark">{{ $producto->nombre }}</h2>
                    </div>

                    <div class="mb-4">
                        <label class="text-uppercase text-muted small fw-bold mb-2">Descripción</label>
                        <div class="p-3 bg-light rounded-3 border">
                            <p class="mb-0 text-secondary">
                                {{ $producto->descripcion ?? 'No hay descripción disponible para este producto.' }}
                            </p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 text-primary rounded px-2 py-2 me-3">
                                    <i class="bi bi-barcode fs-4"></i>
                                </div>
                                <div>
                                    <span class="text-muted small d-block">Código SKU</span>
                                    <span class="fw-bold font-monospace">{{ $producto->sku }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 text-info rounded px-2 py-2 me-3">
                                    <i class="bi bi-fingerprint fs-4"></i>
                                </div>
                                <div>
                                    <span class="text-muted small d-block">ID Interno</span>
                                    <span class="fw-bold">#{{ $producto->id }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top text-muted small py-3">
                    <i class="bi bi-clock me-1"></i> Creado el {{ $producto->created_at->format('d/m/Y') }} &bull; Actualizado el {{ $producto->updated_at->format('d/m/Y H:i') }}
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <label class="text-uppercase text-muted small fw-bold">Precio de Venta</label>
                    <div class="d-flex align-items-center mb-4">
                        <h2 class="display-5 fw-bold text-success mb-0 me-2">{{ number_format($producto->precio, 2) }}</h2>
                        <span class="fs-4 text-success">€</span>
                    </div>

                    <hr class="text-muted opacity-25">

                    @php
                        $stockPercent = min($producto->stock, 100); 
                        $stockColor = $producto->stock > 20 ? 'success' : ($producto->stock > 5 ? 'warning' : 'danger');
                        $stockText = $producto->stock > 20 ? 'En Stock' : ($producto->stock > 5 ? 'Pocas Unidades' : 'Stock Crítico');
                    @endphp

                    <div class="mb-2 d-flex justify-content-between align-items-end">
                        <label class="text-uppercase text-muted small fw-bold">Inventario Actual</label>
                        <span class="badge bg-{{ $stockColor }} bg-opacity-10 text-{{ $stockColor }} border border-{{ $stockColor }} border-opacity-25 rounded-pill px-3">
                            {{ $stockText }}
                        </span>
                    </div>
                    
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-{{ $stockColor }}" role="progressbar" style="width: {{ $stockPercent }}%" aria-valuenow="{{ $producto->stock }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="mt-2 text-end fw-bold text-dark">
                        {{ $producto->stock }} <span class="text-muted fw-normal">unidades disponibles</span>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Acciones</h5>
                    <div class="d-grid gap-2">
                        
                        @if($producto->ficha_tecnica)
                            <a href="{{ asset('storage/' . $producto->ficha_tecnica) }}" target="_blank" class="btn btn-outline-primary py-2 mb-2">
                                <i class="bi bi-file-earmark-pdf me-2"></i>Ver Ficha Técnica
                            </a>
                        @endif

                        <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning py-2">
                            <i class="bi bi-pencil-square me-2"></i>Editar Producto
                        </a>
                        
                        @if(Auth::user()->role === 'admin')
                            <button type="button" class="btn btn-outline-danger py-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="bi bi-trash me-2"></i>Eliminar Producto
                            </button>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(Auth::user()->role === 'admin')
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-danger">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="mb-3 text-danger">
                        <i class="bi bi-exclamation-circle display-1"></i>
                    </div>
                    <p class="mb-0 fs-5">¿Estás seguro de que quieres eliminar <strong>{{ $producto->nombre }}</strong>?</p>
                    <p class="text-muted small mt-2">Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer border-top-0 pt-0 justify-content-center pb-4">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancelar</button>
                    <form action="{{ route('productos.destroy', $producto) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4">Sí, eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection