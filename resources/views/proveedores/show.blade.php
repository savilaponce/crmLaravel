@extends('layouts.app')

@section('title', 'Proveedor: ' . $proveedor->nombre)

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('proveedores.index') }}" class="text-decoration-none">Proveedores</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                </ol>
            </nav>
            <h1 class="h3 text-dark fw-bold mb-0">Perfil del Proveedor</h1>
        </div>
        <a href="{{ route('proveedores.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Volver al listado
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0 pb-0 pt-4 px-4">
                    <div class="d-flex align-items-start">
                        <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3 me-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                            <i class="bi bi-building fs-2"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h2 class="fw-bold text-dark mb-1">{{ $proveedor->nombre }}</h2>
                            <div class="d-flex align-items-center text-muted">
                                <span class="badge bg-light text-dark border me-2 font-monospace">
                                    <i class="bi bi-fingerprint me-1"></i>{{ $proveedor->cif }}
                                </span>
                                <small>ID: #{{ $proveedor->id }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body px-4 py-4">
                    <hr class="text-muted opacity-10 my-4">
                    
                    <h5 class="fw-bold text-secondary mb-3"><i class="bi bi-person-lines-fill me-2"></i>Información de Contacto</h5>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 h-100 bg-light">
                                <label class="small text-muted text-uppercase fw-bold mb-1">Correo Electrónico</label>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-envelope text-primary me-2"></i>
                                    <a href="mailto:{{ $proveedor->email }}" class="text-decoration-none text-dark fw-medium">
                                        {{ $proveedor->email }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 h-100 bg-light">
                                <label class="small text-muted text-uppercase fw-bold mb-1">Teléfono</label>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-telephone text-success me-2"></i>
                                    <span class="fw-medium text-dark">{{ $proveedor->telefono ?? 'No registrado' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="p-3 border rounded-3 bg-light">
                                <label class="small text-muted text-uppercase fw-bold mb-1">Dirección Fiscal / Física</label>
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-geo-alt text-danger me-2 mt-1"></i>
                                    <span class="fw-medium text-dark">{{ $proveedor->direccion ?? 'Dirección no disponible' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-white border-top py-3 px-4">
                    <div class="d-flex align-items-center text-muted small">
                        <i class="bi bi-calendar-check me-2"></i>
                        Registrado en el sistema el: <strong>{{ $proveedor->created_at->format('d/m/Y') }}</strong>
                        <span class="mx-2">&bull;</span>
                        <i class="bi bi-clock me-1"></i> {{ $proveedor->created_at->format('H:i') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">Gestionar Proveedor</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-2">
                        <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-warning py-2">
                            <i class="bi bi-pencil-square me-2"></i>Editar Datos
                        </a>
                        
                        <button type="button" class="btn btn-outline-danger py-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="bi bi-trash me-2"></i>Dar de Baja
                        </button>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm bg-primary text-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-info-circle-fill fs-4 me-3 opacity-50"></i>
                        <h5 class="card-title mb-0">Nota Importante</h5>
                    </div>
                    <p class="card-text opacity-75 small">
                        Antes de eliminar un proveedor, asegúrate de que no tenga productos asociados activos en el inventario para mantener la integridad de los datos.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3 text-danger">
                    <i class="bi bi-exclamation-triangle display-1"></i>
                </div>
                <h5 class="fw-bold">{{ $proveedor->nombre }}</h5>
                <p class="text-muted mb-0">¿Estás seguro de eliminar este proveedor del sistema?</p>
                <p class="text-danger small mt-2 fw-bold">Esta acción es irreversible.</p>
            </div>
            <div class="modal-footer border-top-0 pt-0 justify-content-center pb-4">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">Sí, eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection