@extends('layouts.app')

@section('title', 'Gestión de Personal')

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-dark fw-bold mb-0">Equipo de Trabajo</h1>
            <p class="text-muted small mb-0">Administra la nómina y los perfiles de tus empleados.</p>
        </div>
        <a href="{{ route('empleados.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus-fill me-2"></i>Registrar Empleado
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
                        <input type="text" class="form-control bg-light border-start-0 ps-0" placeholder="Buscar por nombre, cargo o email...">
                    </div>
                </div>
                <div class="col-md-6 text-md-end text-muted small">
                    Plantilla activa: <strong>{{ $empleados->count() }}</strong> empleados
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($empleados->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-uppercase small text-muted">
                            <tr>
                                <th class="ps-4 py-3 border-0">Colaborador</th>
                                <th class="py-3 border-0">Cargo / Puesto</th>
                                <th class="py-3 border-0">Salario</th>
                                <th class="py-3 border-0">Ingreso</th>
                                <th class="py-3 border-0 text-end pe-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($empleados as $empleado)
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center justify-content-center bg-dark text-white rounded-circle me-3 fw-bold shadow-sm" style="width: 40px; height: 40px;">
                                            {{ substr($empleado->nombre, 0, 1) }}
                                        </div>
                                        <div>
                                            <a href="{{ route('empleados.show', $empleado) }}" class="text-dark fw-bold text-decoration-none stretched-link-custom">
                                                {{ $empleado->nombre }}
                                            </a>
                                            <div class="small text-muted">{{ $empleado->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-2 py-1">
                                        {{ $empleado->puesto }}
                                    </span>
                                </td>

                                <td>
                                    <div class="fw-medium text-dark">
                                        {{ number_format($empleado->salario, 2) }} €
                                    </div>
                                    <small class="text-muted" style="font-size: 0.75rem;">Anual/Mensual</small>
                                </td>

                                <td>
                                    @if(isset($empleado->fecha_contratacion))
                                        <div class="text-muted small">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            {{ \Carbon\Carbon::parse($empleado->fecha_contratacion)->format('d/m/Y') }}
                                        </div>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>

                                <td class="text-end pe-4">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('empleados.show', $empleado) }}">
                                                    <i class="bi bi-person-lines-fill me-2 text-primary"></i>Ver Perfil
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('empleados.edit', $empleado) }}">
                                                    <i class="bi bi-pencil me-2 text-warning"></i>Editar Datos
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $empleado->id }}">
                                                    <i class="bi bi-trash me-2"></i>Dar de Baja
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="modal fade text-start" id="deleteModal{{ $empleado->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-body text-center p-4">
                                                    <div class="text-danger mb-3"><i class="bi bi-person-x display-4"></i></div>
                                                    <h6 class="fw-bold mb-2">¿Dar de baja?</h6>
                                                    <p class="small text-muted">Estás a punto de eliminar a <strong>{{ $empleado->nombre }}</strong> del sistema.</p>
                                                    <div class="d-flex justify-content-center gap-2 mt-4">
                                                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('empleados.destroy', $empleado) }}" method="POST">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Confirmar</button>
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
                        {{ $empleados->links() }}
                    </div>
                </div>

            @else
                <div class="text-center py-5">
                    <div class="mb-3 text-muted opacity-25">
                        <i class="bi bi-people display-1"></i>
                    </div>
                    <h4 class="fw-bold">No hay empleados registrados</h4>
                    <p class="text-muted col-md-6 mx-auto mb-4">
                        Comienza a construir tu equipo registrando al primer colaborador.
                    </p>
                    <a href="{{ route('empleados.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i>Registrar Empleado
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection