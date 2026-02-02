@extends('layouts.app')
@section('title', 'Detalle Empleado')
@section('content')
<div class="row"><div class="col-md-8 mx-auto"><div class="card shadow">
<div class="card-header bg-info text-white"><h4 class="mb-0"><i class="bi bi-person-badge"></i> Detalle del Empleado</h4></div>
<div class="card-body">
<table class="table table-borderless">
<tbody>
<tr><th width="200">ID:</th><td>{{ $empleado->id }}</td></tr>
<tr><th>Nombre:</th><td>{{ $empleado->nombre }}</td></tr>
<tr><th>Email:</th><td>{{ $empleado->email }}</td></tr>
<tr><th>Teléfono:</th><td>{{ $empleado->telefono ?? 'N/A' }}</td></tr>
<tr><th>Puesto:</th><td><strong>{{ $empleado->puesto }}</strong></td></tr>
<tr><th>Salario:</th><td>{{ number_format($empleado->salario, 2) }} €</td></tr>
<tr><th>Fecha Contratación:</th><td>{{ $empleado->fecha_contratacion->format('d/m/Y') }}</td></tr>
<tr><th>Registrado:</th><td>{{ $empleado->created_at->format('d/m/Y H:i') }}</td></tr>
</tbody>
</table>
<div class="d-flex justify-content-between mt-4">
<a href="{{ route('empleados.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
<div>
<a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Editar</a>
<form action="{{ route('empleados.destroy', $empleado) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar?');">@csrf @method('DELETE')<button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Eliminar</button></form>
</div></div></div></div></div></div>
@endsection
