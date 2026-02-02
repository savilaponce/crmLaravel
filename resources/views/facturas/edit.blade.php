@extends('layouts.app')
@section('title', 'Editar Factura')
@section('content')
<div class="row"><div class="col-md-8 mx-auto"><div class="card shadow">
<div class="card-header bg-warning text-dark"><h4 class="mb-0"><i class="bi bi-pencil"></i> Editar Factura</h4></div>
<div class="card-body">
<form action="{{ route('facturas.update', $factura) }}" method="POST">@csrf @method('PUT')
<div class="mb-3"><label>Número de Factura *</label><input type="text" class="form-control @error('numero_factura') is-invalid @enderror" name="numero_factura" value="{{ old('numero_factura', $factura->numero_factura) }}" required>@error('numero_factura')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="mb-3">
<label>Cliente *</label>
<select class="form-select @error('cliente_id') is-invalid @enderror" name="cliente_id" required>
<option value="">Seleccione un cliente</option>
@foreach($clientes as $cliente)
<option value="{{ $cliente->id }}" {{ old('cliente_id', $factura->cliente_id) == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
@endforeach
</select>
@error('cliente_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3"><label>Fecha *</label><input type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="{{ old('fecha', $factura->fecha->format('Y-m-d')) }}" required>@error('fecha')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="mb-3"><label>Total (€) *</label><input type="number" step="0.01" class="form-control @error('total') is-invalid @enderror" name="total" value="{{ old('total', $factura->total) }}" required>@error('total')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="mb-3">
<label>Estado *</label>
<select class="form-select @error('estado') is-invalid @enderror" name="estado" required>
<option value="pendiente" {{ old('estado', $factura->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
<option value="pagada" {{ old('estado', $factura->estado) == 'pagada' ? 'selected' : '' }}>Pagada</option>
<option value="cancelada" {{ old('estado', $factura->estado) == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
</select>
@error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="d-flex justify-content-between">
<a href="{{ route('facturas.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
<button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Actualizar</button>
</div></form></div></div></div></div>
@endsection
