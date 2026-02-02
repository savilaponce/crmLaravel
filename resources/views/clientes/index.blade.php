@extends('layouts.app')

@section('title', 'Gestión de Clientes')

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-dark fw-bold mb-0">Clientes</h1>
            <p class="text-muted small mb-0">Gestiona tu cartera de clientes y empresas.</p>
        </div>
        <a href="{{ route('clientes.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Nuevo Cliente
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
                        <input type="text" class="form-control bg-light border-start-0 ps-0" placeholder="Buscar cliente por nombre, email o empresa...">
                    </div>
                </div>
                <div class="col-md-6 text-md-end text-muted small">
                    Mostrando <strong>{{ $clientes->count() }}</strong> registros
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($clientes->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-uppercase small text-muted">
                            <tr>
                                <th class="ps-4 py-3 border-0">Cliente</th>
                                <th class="py-3 border-0">Contacto</th>
                                <th class="py-3 border-0">Empresa</th>
                                <th class="py-3 border-0 text-end pe-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientes as $cliente)
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle me-3 fw-bold" style="width: 40px; height: 40px;">
                                            {{ substr($cliente->nombre, 0, 1) }}
                                        </div>
                                        <div>
                                            <a href="{{ route('clientes.show', $cliente) }}" class="text-dark fw-bold text-decoration-none stretched-link-custom">
                                                {{ $cliente->nombre }}
                                            </a>
                                            <div class="small text-muted">{{ $cliente->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    @if($cliente->telefono)
                                        <span class="text-dark"><i class="bi bi-telephone me-1 text-muted"></i> {{ $cliente->telefono }}</span>
                                    @else
                                        <span class="text-muted small fst-italic">Sin teléfono</span>
                                    @endif
                                </td>

                                <td>
                                    @if($cliente->empresa)
                                        <span class="badge bg-light text-dark border">
                                            <i class="bi bi-building me-1"></i> {{ $cliente->empresa }}
                                        </span>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>

                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <a href="{{ route('clientes.show', $cliente) }}" class="btn btn-sm btn-light text-secondary" title="Ver Detalle">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-light text-primary" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-light text-danger" title="Eliminar" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $cliente->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>

                                    <div class="modal fade text-start" id="deleteModal{{ $cliente->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-body text-center p-4">
                                                    <div class="text-danger mb-3"><i class="bi bi-exclamation-circle display-4"></i></div>
                                                    <h6 class="fw-bold mb-2">¿Eliminar Cliente?</h6>
                                                    <p class="small text-muted">{{ $cliente->nombre }}</p>
                                                    <div class="d-flex justify-content-center gap-2 mt-4">
                                                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST">
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
                        {{ $clientes->links() }} 
                        </div>
                </div>

            @else
                <div class="text-center py-5">
                    <div class="mb-3 text-muted opacity-25">
                        <i class="bi bi-people display-1"></i>
                    </div>
                    <h4 class="fw-bold">No hay clientes todavía</h4>
                    <p class="text-muted col-md-6 mx-auto mb-4">
                        Comienza agregando tu primer cliente para gestionar sus datos, facturas y seguimiento.
                    </p>
                    <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i>Agregar Primer Cliente
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection