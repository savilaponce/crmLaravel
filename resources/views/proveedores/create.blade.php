@extends('layouts.app')
@section('title', 'Nuevo Proveedor')
@section('content')
<div class="row"><div class="col-md-8 mx-auto"><div class="card shadow">
<div class="card-header bg-warning text-dark"><h4 class="mb-0"><i class="bi bi-truck"></i> Nuevo Proveedor</h4></div>
<div class="card-body">
<form action="{{ route('proveedores.store') }}" method="POST">@csrf
<div class="mb-3"><label>Nombre *</label><input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required>@error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="mb-3"><label>Email *</label><input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="mb-3"><label>CIF *</label><input type="text" class="form-control @error('cif') is-invalid @enderror" name="cif" value="{{ old('cif') }}" required>@error('cif')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="mb-3"><label>Teléfono</label><input type="text" class="form-control" name="telefono" value="{{ old('telefono') }}"></div>
<div class="mb-3"><label>Dirección</label><textarea class="form-control" name="direccion" rows="3">{{ old('direccion') }}</textarea></div>
<div class="d-flex justify-content-between">
<a href="{{ route('proveedores.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
<button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Guardar</button>
</div></form></div></div></div></div>
@endsection
