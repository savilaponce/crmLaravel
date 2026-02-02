@extends('layouts.app')
@section('title', 'Editar Empleado')
@section('content')
<div class="row"><div class="col-md-8 mx-auto"><div class="card shadow">
<div class="card-header bg-warning text-dark"><h4 class="mb-0"><i class="bi bi-pencil"></i> Editar Empleado</h4></div>
<div class="card-body">
<form action="{{ route('empleados.update', $empleado) }}" method="POST">@csrf @method('PUT')
<div class="mb-3"><label>Nombre *</label><input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $empleado->nombre) }}" required>@error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="mb-3"><label>Email *</label><input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $empleado->email) }}" required>@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="mb-3"><label>Teléfono</label><input type="text" class="form-control" name="telefono" value="{{ old('telefono', $empleado->telefono) }}"></div>
<div class="mb-3"><label>Puesto *</label><input type="text" class="form-control @error('puesto') is-invalid @enderror" name="puesto" value="{{ old('puesto', $empleado->puesto) }}" required>@error('puesto')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="mb-3"><label>Salario (€) *</label><input type="number" step="0.01" class="form-control @error('salario') is-invalid @enderror" name="salario" value="{{ old('salario', $empleado->salario) }}" required>@error('salario')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="mb-3"><label>Fecha de Contratación *</label><input type="date" class="form-control @error('fecha_contratacion') is-invalid @enderror" name="fecha_contratacion" value="{{ old('fecha_contratacion', $empleado->fecha_contratacion->format('Y-m-d')) }}" required>@error('fecha_contratacion')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="d-flex justify-content-between">
<a href="{{ route('empleados.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
<button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Actualizar</button>
</div></form></div></div></div></div>
@endsection
