@extends('layouts.app')

@section('title', 'Perfil: ' . $empleado->nombre)

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('empleados.index') }}" class="text-decoration-none">Empleados</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                </ol>
            </nav>
            <h1 class="h3 text-dark fw-bold mb-0">Ficha del Empleado</h1>
        </div>
        <a href="{{ route('empleados.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Volver
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body p-5">
                    <div class="mx-auto mb-4 d-flex align-items-center justify-content-center bg-primary text-white rounded-circle shadow-sm" style="width: 120px; height: 120px; font-size: 3rem;">
                        <i class="bi bi-person"></i>
                    </div>
                    
                    <h3 class="fw-bold text-dark mb-1">{{ $empleado->nombre }}</h3>
                    <p class="text-primary fw-medium mb-1">{{ $empleado->puesto }}</p>
                    <span class="badge bg-light text-muted border rounded-pill px-3 mb-4">ID: #{{ $empleado->id }}</span>

                    <div class="d-grid gap-2 mt-4">
                        <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square me-2"></i>Editar Perfil
                        </a>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="bi bi-trash me-2"></i>Dar de Baja
                        </button>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0 pb-4 text-muted small">
                    <i class="bi bi-clock-history me-1"></i> Miembro desde {{ $empleado->fecha_contratacion->format('Y') }}
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title fw-bold mb-0"><i class="bi bi-person-lines-fill me-2 text-primary"></i>Información Personal y Laboral</h5>
                </div>
                <div class="card-body p-4">
                    
                    <h6 class="text-uppercase text-muted small fw-bold mb-3">Contacto</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border h-100">
                                <label class="small text-muted mb-1">Correo Electrónico</label>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-envelope text-primary me-2"></i>
                                    <span class="fw-medium text-dark">{{ $empleado->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border h-100">
                                <label class="small text-muted mb-1">Teléfono Móvil</label>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-phone text-success me-2"></i>
                                    <span class="fw-medium text-dark">{{ $empleado->telefono ?? 'No registrado' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="text-muted opacity-10 mb-4">

                    <h6 class="text-uppercase text-muted small fw-bold mb-3">Detalles del Contrato</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border rounded-3">
                                <div class="bg-success bg-opacity-10 text-success p-3 rounded me-3">
                                    <i class="bi bi-cash-stack fs-4"></i>
                                </div>
                                <div>
                                    <span class="text-muted small d-block">Salario Anual/Mensual</span>
                                    <span class="fs-5 fw-bold text-dark">{{ number_format($empleado->salario, 2) }} €</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border rounded-3">
                                <div class="bg-info bg-opacity-10 text-info p-3 rounded me-3">
                                    <i class="bi bi-calendar-check fs-4"></i>
                                </div>
                                <div>
                                    <span class="text-muted small d-block">Fecha de Contratación</span>
                                    <span class="fs-5 fw-bold text-dark">{{ $empleado->fecha_contratacion->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 text-muted small">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Registro en sistema:</strong> {{ $empleado->created_at->format('d/m/Y H:i') }}
                            </div>
                            <div class="col-md-6 text-md-end">
                                <strong>Última actualización:</strong> {{ $empleado->updated_at->format('d/m/Y H:i') }}
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
                <h5 class="modal-title fw-bold text-danger">Confirmar Despido / Baja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3 text-danger">
                    <i class="bi bi-person-x-fill display-1"></i>
                </div>
                <h5 class="fw-bold">{{ $empleado->nombre }}</h5>
                <p class="text-muted mb-0">¿Estás seguro de que deseas eliminar este registro?</p>
                <p class="text-muted small mt-2">Esta acción eliminará sus datos del sistema permanentemente.</p>
            </div>
            <div class="modal-footer border-top-0 pt-0 justify-content-center pb-4">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('empleados.destroy', $empleado) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">Confirmar Baja</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection