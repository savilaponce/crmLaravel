@extends('layouts.app')
@section('title', 'Detalle Proveedor')
@section('content')
<div class="row"><div class="col-md-8 mx-auto"><div class="card shadow">
<div class="card-header bg-info text-white"><h4 class="mb-0"><i class="bi bi-truck"></i> Detalle del Proveedor</h4></div>
<div class="card-body">
<table class="table table-borderless">
<tbody>
<tr><th width="200">ID:</th><td>{{ $proveedor->id }}</td></tr>
<tr><th>Nombre:</th><td>{{ $proveedor->nombre }}</td></tr>
<tr><th>Email:</th><td>{{ $proveedor->email }}</td></tr>
<tr><th>CIF:</th><td><code>{{ $proveedor->cif }}</code></td></tr>
<tr><th>Teléfono:</th><td>{{ $proveedor->telefono ?? 'N/A' }}</td></tr>
<tr><th>Dirección:</th><td>{{ $proveedor->direccion ?? 'N/A' }}</td></tr>
<tr><th>Registrado:</th><td>{{ $proveedor->created_at->format('d/m/Y H:i') }}</td></tr>
</tbody>
</table>
<div class="d-flex justify-content-between mt-4">
<a href="{{ route('proveedores.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
<div>
<a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Editar</a>
<form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar?');">@csrf @method('DELETE')<button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Eliminar</button></form>
</div></div></div></div></div></div>
@endsection
