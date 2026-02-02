@extends('layouts.app')
@section('title', 'Empleados')
@section('content')
<div class="d-flex justify-content-between mb-4">
<h2><i class="bi bi-person-badge"></i> Gestión de Empleados</h2>
<a href="{{ route('empleados.create') }}" class="btn btn-danger"><i class="bi bi-plus-circle"></i> Nuevo Empleado</a>
</div>
<div class="card shadow">
<div class="card-body">
@if($empleados->count() > 0)
<div class="table-responsive">
<table class="table table-hover">
<thead class="table-light"><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Puesto</th><th>Salario</th><th>Acciones</th></tr></thead>
<tbody>
@foreach($empleados as $empleado)
<tr>
<td>{{ $empleado->id }}</td>
<td>{{ $empleado->nombre }}</td>
<td>{{ $empleado->email }}</td>
<td>{{ $empleado->puesto }}</td>
<td>{{ number_format($empleado->salario, 2) }} €</td>
<td>
<div class="btn-group">
<a href="{{ route('empleados.show', $empleado) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
<a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
<form action="{{ route('empleados.destroy', $empleado) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar?');">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button></form>
</div>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
{{ $empleados->links() }}
@else
<div class="alert alert-info">No hay empleados. <a href="{{ route('empleados.create') }}">Crear primero</a></div>
@endif
</div>
</div>
@endsection
