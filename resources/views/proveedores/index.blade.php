@extends('layouts.app')
@section('title', 'Proveedores - CRM Laravel')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-truck"></i> Gestión de Proveedores</h2>
    <a href="{{ route('proveedores.create') }}" class="btn btn-warning"><i class="bi bi-plus-circle"></i> Nuevo Proveedor</a>
</div>
<div class="card shadow">
    <div class="card-body">
        @if($proveedores->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr><th>ID</th><th>Nombre</th><th>Email</th><th>CIF</th><th>Teléfono</th><th>Acciones</th></tr>
                    </thead>
                    <tbody>
                        @foreach($proveedores as $proveedor)
                        <tr>
                            <td>{{ $proveedor->id }}</td>
                            <td>{{ $proveedor->nombre }}</td>
                            <td>{{ $proveedor->email }}</td>
                            <td><code>{{ $proveedor->cif }}</code></td>
                            <td>{{ $proveedor->telefono ?? 'N/A' }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('proveedores.show', $proveedor) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $proveedores->links() }}
        @else
            <div class="alert alert-info">No hay proveedores. <a href="{{ route('proveedores.create') }}">Crear primero</a></div>
        @endif
    </div>
</div>
@endsection
