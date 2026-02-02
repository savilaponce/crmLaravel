@extends('layouts.app')

@section('title', 'Directorio de Proveedores')

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-dark fw-bold mb-0">Proveedores</h1>
            <p class="text-muted small mb-0">Gestión de suministros y contactos externos.</p>
        </div>
        <a href="{{ route('proveedores.create') }}" class="btn btn-warning text-white">
            <i class="bi bi-plus-lg me-2"></i>Nuevo Proveedor
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
                        <input type="text" class="form-control bg-light border-start-0 ps-0" placeholder="Buscar por empresa, CIF o email...">
                    </div>
                </div>
                <div class="col-md-6 text-md-end text-muted small">
                    Directorio activo: <strong>{{ $proveedores->count() }}</strong> empresas
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($proveedores->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-uppercase small text-muted">
                            <tr>
                                <th class="ps-4 py-3 border-0">Empresa / Proveedor</th>
                                <th class="py-3 border-0">Identificación (CIF)</th>
                                <th class="py-3 border-0">Contacto</th>
                                <th class="py-3 border-0">Fecha Alta</th>
                                <th class="py-3 border-0 text-end pe-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proveedores as $proveedor)
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-warning bg-opacity-10 text-warning rounded p-2 me-3 d-flex align-items-center justify-content-center border border-warning border-opacity-25" style="width: 45px; height: 45px;">
                                            <i class="bi bi-building fs-5"></i>
                                        </div>
                                        <div>
                                            <a href="{{ route('proveedores.show', $proveedor) }}" class="text-dark fw-bold text-decoration-none stretched-link-custom">
                                                {{ $proveedor->nombre }}
                                            </a>
                                            <div class="small text-muted">{{ $proveedor->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark border font-monospace">
                                        {{ $proveedor->cif }}
                                    </span>
                                </td>

                                <td>
                                    @if($proveedor->telefono)
                                        <div class="text-dark"><i class="bi bi-telephone me-1 text-muted"></i> {{ $proveedor->telefono }}</div>
                                    @else
                                        <span class="text-muted small fst-italic">No disponible</span>
                                    @endif
                                </td>

                                <td class="text-muted small">
                                    {{ $proveedor->created_at->format('d/m/Y') }}
                                </td>

                                <td class="text-end pe-4">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light text-muted" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('proveedores.show', $proveedor) }}">
                                                    <i class="bi bi-eye me-2 text-primary"></i>Ver Perfil
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('proveedores.edit', $proveedor) }}">
                                                    <i class="bi bi-pencil me-2 text-warning"></i>Editar Datos
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $proveedor->id }}">
                                                    <i class="bi bi-trash me-2"></i>Eliminar
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="modal fade text-start" id="deleteModal{{ $proveedor->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-body text-center p-4">
                                                    <div class="text-danger mb-3"><i class="bi bi-exclamation-triangle display-4"></i></div>
                                                    <h6 class="fw-bold mb-2">¿Eliminar Proveedor?</h6>
                                                    <p class="small text-muted">
                                                        Estás a punto de borrar a <strong>{{ $proveedor->nombre }}</strong>.
                                                        <br>Asegúrate de que no suministra productos activos.
                                                    </p>
                                                    <div class="d-flex justify-content-center gap-2 mt-4">
                                                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST">
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
                        {{ $proveedores->links() }}
                    </div>
                </div>

            @else
                <div class="text-center py-5">
                    <div class="mb-3 text-muted opacity-25">
                        <i class="bi bi-truck display-1"></i>
                    </div>
                    <h4 class="fw-bold">No hay proveedores registrados</h4>
                    <p class="text-muted col-md-6 mx-auto mb-4">
                        Registra a tus socios comerciales para llevar el control de compras y suministros.
                    </p>
                    <a href="{{ route('proveedores.create') }}" class="btn btn-warning text-white">
                        <i class="bi bi-plus-lg me-2"></i>Nuevo Proveedor
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection