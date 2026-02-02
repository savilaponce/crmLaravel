@extends('layouts.app')

@section('title', 'Cliente: ' . $cliente->nombre)

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}" class="text-decoration-none">Clientes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                </ol>
            </nav>
            <h1 class="h3 text-dark fw-bold mb-0">Visión General del Cliente</h1>
        </div>
        <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Volver
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body p-5">
                    <div class="mx-auto mb-4 d-flex align-items-center justify-content-center bg-primary bg-gradient text-white rounded-circle shadow-sm" style="width: 100px; height: 100px; font-size: 2.5rem; font-weight: bold;">
                        {{ substr($cliente->nombre, 0, 1) }}
                    </div>
                    
                    <h3 class="fw-bold text-dark mb-1">{{ $cliente->nombre }}</h3>
                    
                    @if($cliente->empresa)
                        <p class="text-muted fw-medium mb-3">
                            <i class="bi bi-building me-1"></i> {{ $cliente->empresa }}
                        </p>
                    @else
                        <p class="text-muted fst-italic mb-3">Particular</p>
                    @endif

                    <div class="d-flex justify-content-center gap-2 mb-4">
                        <span class="badge bg-light text-dark border">ID: {{ $cliente->id }}</span>
                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">Activo</span>
                    </div>

                    <hr class="opacity-10 my-4">

                    <div class="d-grid gap-2">
                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-primary">
                            <i class="bi bi-pencil-square me-2"></i>Editar Datos
                        </a>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="bi bi-trash me-2"></i>Eliminar Cliente
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title fw-bold mb-0"><i class="bi bi-person-vcard me-2 text-primary"></i>Datos de Contacto</h5>
                </div>
                <div class="card-body p-4">
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 h-100 hover-bg-light transition">
                                <label class="small text-muted text-uppercase fw-bold mb-2">Correo Electrónico</label>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded me-3">
                                        <i class="bi bi-envelope-fill"></i>
                                    </div>
                                    <div class="text-truncate">
                                        <a href="mailto:{{ $cliente->email }}" class="text-decoration-none text-dark fw-medium stretched-link">
                                            {{ $cliente->email }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 h-100 hover-bg-light transition">
                                <label class="small text-muted text-uppercase fw-bold mb-2">Teléfono</label>
                                <div class="d-flex align-items-center">
                                    <div class="bg-success bg-opacity-10 text-success p-2 rounded me-3">
                                        <i class="bi bi-telephone-fill"></i>
                                    </div>
                                    <div>
                                        <span class="fw-medium text-dark">
                                            {{ $cliente->telefono ?? 'No disponible' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="small text-muted text-uppercase fw-bold mb-2">Dirección Física</label>
                        <div class="p-3 border rounded-3 bg-light">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-geo-alt-fill text-danger me-3 mt-1 fs-5"></i>
                                <div>
                                    <p class="mb-0 text-dark fw-medium">{{ $cliente->direccion ?? 'Sin dirección registrada' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-top pt-3">
                        <div class="row text-muted small">
                            <div class="col-md-6">
                                <i class="bi bi-calendar-plus me-1"></i>
                                Cliente registrado el: <strong>{{ $cliente->created_at->format('d/m/Y') }}</strong>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <i class="bi bi-arrow-repeat me-1"></i>
                                Última actualización: <strong>{{ $cliente->updated_at->diffForHumans() }}</strong>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Eliminar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3 text-danger opacity-75">
                    <i class="bi bi-exclamation-triangle-fill display-1"></i>
                </div>
                <h5 class="fw-bold">{{ $cliente->nombre }}</h5>
                <p class="text-muted mb-0">¿Estás seguro de que deseas eliminar este cliente?</p>
                <p class="text-muted small mt-2">También se podría perder el historial asociado si no está protegido.</p>
            </div>
            <div class="modal-footer border-top-0 pt-0 justify-content-center pb-4">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">Sí, eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
