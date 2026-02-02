@extends('layouts.app')

@section('title', 'Factura #' . $factura->numero_factura)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('facturas.index') }}" class="text-decoration-none">Facturas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalle</li>
                </ol>
            </nav>
            <h1 class="h3 text-dark fw-bold">Detalle de Factura</h1>
        </div>
        <a href="{{ route('facturas.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Volver al listado
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    
                    <div class="row border-bottom pb-4 mb-4 align-items-center">
                        <div class="col-md-6">
                            <h2 class="fw-bold text-primary mb-1">FACTURA</h2>
                            <span class="text-muted">#{{ $factura->numero_factura }}</span>
                        </div>
                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                            @if($factura->estado == 'pagada')
                                <div class="badge bg-success bg-opacity-10 text-success fs-6 px-3 py-2 border border-success border-opacity-25 rounded-pill">
                                    <i class="bi bi-check-circle-fill me-2"></i>PAGADA
                                </div>
                            @elseif($factura->estado == 'pendiente')
                                <div class="badge bg-warning bg-opacity-10 text-warning fs-6 px-3 py-2 border border-warning border-opacity-25 rounded-pill">
                                    <i class="bi bi-clock-fill me-2"></i>PENDIENTE
                                </div>
                            @else
                                <div class="badge bg-danger bg-opacity-10 text-danger fs-6 px-3 py-2 border border-danger border-opacity-25 rounded-pill">
                                    <i class="bi bi-x-circle-fill me-2"></i>CANCELADA
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <h6 class="text-uppercase text-muted fw-bold small mb-3">Facturar a:</h6>
                            <div class="p-3 bg-light rounded-3 border">
                                <h5 class="fw-bold mb-1">
                                    <a href="{{ route('clientes.show', $factura->cliente) }}" class="text-decoration-none text-dark hover-primary">
                                        {{ $factura->cliente->nombre }}
                                    </a>
                                </h5>
                                <p class="mb-1 text-muted"><i class="bi bi-envelope me-2"></i>{{ $factura->cliente->email ?? 'Sin email' }}</p>
                                <p class="mb-0 text-muted"><i class="bi bi-telephone me-2"></i>{{ $factura->cliente->telefono ?? 'Sin teléfono' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <h6 class="text-uppercase text-muted fw-bold small mb-3">Detalles:</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <span class="text-muted me-2">Fecha de Emisión:</span>
                                    <strong>{{ $factura->fecha->format('d/m/Y') }}</strong>
                                </li>
                                <li class="mb-2">
                                    <span class="text-muted me-2">Fecha de Registro:</span>
                                    <span>{{ $factura->created_at->format('d/m/Y H:i') }}</span>
                                </li>
                                <li>
                                    <span class="text-muted me-2">ID Interno:</span>
                                    <code>{{ $factura->id }}</code>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3">Descripción</th>
                                    <th class="text-end py-3" width="200">Importe</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-3">Servicios / Productos (Resumen General)</td>
                                    <td class="text-end fw-bold py-3">{{ number_format($factura->total, 2) }} €</td>
                                </tr>
                                </tbody>
                            <tfoot class="bg-light">
                                <tr>
                                    <td class="text-end fw-bold py-3">TOTAL</td>
                                    <td class="text-end fw-bold fs-5 text-primary py-3">
                                        {{ number_format($factura->total, 2) }} €
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-5 border-top pt-4">
                        <a href="{{ route('facturas.edit', $factura) }}" class="btn btn-warning text-white">
                            <i class="bi bi-pencil-square me-2"></i>Editar Factura
                        </a>
                        
                        <form action="{{ route('facturas.destroy', $factura) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta factura permanentemente?');">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-2"></i>Eliminar
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection