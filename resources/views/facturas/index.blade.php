@extends('layouts.app')

@section('title', 'Gestión de Facturación')

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-dark fw-bold mb-0">Facturación</h1>
            <p class="text-muted small mb-0">Historial de facturas emitidas y estado de cobros.</p>
        </div>
        <a href="{{ route('facturas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Nueva Factura
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        
        <div class="card-header bg-white py-3">
            <div class="row g-3 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control bg-light border-start-0 ps-0" placeholder="Buscar por número o cliente...">
                    </div>
                </div>
                <div class="col-md-7 text-md-end">
                    <div class="d-inline-flex align-items-center gap-2">
                        <span class="text-muted small me-2">Filtros rápidos:</span>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3">Todas</button>
                        <button class="btn btn-sm btn-outline-success rounded-pill px-3">Pagadas</button>
                        <button class="btn btn-sm btn-outline-warning rounded-pill px-3">Pendientes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($facturas->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-uppercase small text-muted">
                            <tr>
                                <th class="ps-4 py-3 border-0">Nº Factura</th>
                                <th class="py-3 border-0">Cliente</th>
                                <th class="py-3 border-0">Fecha Emisión</th>
                                <th class="py-3 border-0">Estado</th>
                                <th class="py-3 border-0 text-end">Total</th>
                                <th class="py-3 border-0 text-end pe-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($facturas as $factura)
                            <tr>
                                <td class="ps-4 py-3">
                                    <a href="{{ route('facturas.show', $factura) }}" class="fw-bold font-monospace text-primary text-decoration-none">
                                        #{{ $factura->numero_factura }}
                                    </a>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light text-secondary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <span class="fw-medium text-dark">{{ $factura->cliente->nombre }}</span>
                                    </div>
                                </td>

                                <td class="text-muted small">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $factura->fecha->format('d/m/Y') }}
                                </td>

                                <td>
                                    @if($factura->estado == 'pagada')
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-2">
                                            <i class="bi bi-check-circle-fill me-1"></i> Pagada
                                        </span>
                                    @elseif($factura->estado == 'pendiente')
                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill px-3 py-2">
                                            <i class="bi bi-clock-fill me-1"></i> Pendiente
                                        </span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3 py-2">
                                            <i class="bi bi-x-circle-fill me-1"></i> Cancelada
                                        </span>
                                    @endif
                                </td>

                                <td class="text-end fw-bold text-dark fs-6">
                                    {{ number_format($factura->total, 2) }} €
                                </td>

                                <td class="text-end pe-4">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light text-muted" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('facturas.show', $factura) }}">
                                                    <i class="bi bi-eye me-2 text-primary"></i>Ver Detalles
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('facturas.edit', $factura) }}">
                                                    <i class="bi bi-pencil me-2 text-warning"></i>Editar
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $factura->id }}">
                                                    <i class="bi bi-trash me-2"></i>Eliminar
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="modal fade text-start" id="deleteModal{{ $factura->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-body text-center p-4">
                                                    <div class="text-danger mb-3"><i class="bi bi-receipt-cutoff display-4"></i></div>
                                                    <h6 class="fw-bold mb-2">¿Eliminar Factura?</h6>
                                                    <p class="small text-muted">Esta acción borrará el registro fiscal #{{ $factura->numero_factura }}.</p>
                                                    <div class="d-flex justify-content-center gap-2 mt-4">
                                                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('facturas.destroy', $factura) }}" method="POST">
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
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Total Facturado (Vista actual): <strong>{{ number_format($facturas->sum('total'), 2) }} €</strong>
                        </div>
                        <div>
                            {{ $facturas->links() }}
                        </div>
                    </div>
                </div>

            @else
                <div class="text-center py-5">
                    <div class="mb-3 text-muted opacity-25">
                        <i class="bi bi-receipt display-1"></i>
                    </div>
                    <h4 class="fw-bold">No hay facturas emitidas</h4>
                    <p class="text-muted col-md-6 mx-auto mb-4">
                        Genera tu primera factura para empezar a llevar el control de ingresos.
                    </p>
                    <a href="{{ route('facturas.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i>Crear Nueva Factura
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection