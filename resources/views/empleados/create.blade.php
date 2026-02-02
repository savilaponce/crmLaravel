@extends('layouts.app')
@section('title', 'Nuevo Empleado')
@section('content')
<div class="row"><div class="col-md-8 mx-auto"><div class="card shadow">
<div class="card-header bg-danger text-white"><h4 class="mb-0"><i class="bi bi-person-plus"></i> Nuevo Empleado</h4></div>
<div class="card-body">
<form action="{{ route('empleados.store') }}" method="POST">@csrf
<div class="mb-3"><label>Nombre *</label><input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required>@error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="mb-3"><label>Email *</label><input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="mb-3"><label>Teléfono</label><input type="text" class="form-control" name="telefono" value="{{ old('telefono') }}"></div>
<div class="mb-3"><label>Puesto *</label><input type="text" class="form-control @error('puesto') is-invalid @enderror" name="puesto" value="{{ old('puesto') }}" required>@error('puesto')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="mb-3"><label>Salario (€) *</label><input type="number" step="0.01" class="form-control @error('salario') is-invalid @enderror" name="salario" value="{{ old('salario') }}" required>@error('salario')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="mb-3"><label>Fecha de Contratación *</label><input type="date" class="form-control @error('fecha_contratacion') is-invalid @enderror" name="fecha_contratacion" value="{{ old('fecha_contratacion') }}" required>@error('fecha_contratacion')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="d-flex justify-content-between">
<a href="{{ route('empleados.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
<button type="submit" class="btn btn-danger"><i class="bi bi-save"></i> Guardar</button>
</div></form></div></div></div></div>
@endsection
