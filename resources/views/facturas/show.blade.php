@extends('layouts.app')
@section('title', 'Detalle Factura')
@section('content')
<div class="row"><div class="col-md-8 mx-auto"><div class="card shadow">
<div class="card-header bg-info text-white"><h4 class="mb-0"><i class="bi bi-receipt"></i> Detalle de la Factura</h4></div>
<div class="card-body">
<table class="table table-borderless">
<tbody>
<tr><th width="200">ID:</th><td>{{ $factura->id }}</td></tr>
<tr><th>Número Factura:</th><td><code>{{ $factura->numero_factura }}</code></td></tr>
<tr><th>Cliente:</th><td><a href="{{ route('clientes.show', $factura->cliente) }}">{{ $factura->cliente->nombre }}</a></td></tr>
<tr><th>Fecha:</th><td>{{ $factura->fecha->format('d/m/Y') }}</td></tr>
<tr><th>Total:</th><td><strong>{{ number_format($factura->total, 2) }} €</strong></td></tr>
<tr><th>Estado:</th><td>
@if($factura->estado == 'pagada')
<span class="badge bg-success">Pagada</span>
@elseif($factura->estado == 'pendiente')
<span class="badge bg-warning">Pendiente</span>
@else
<span class="badge bg-danger">Cancelada</span>
@endif
</td></tr>
<tr><th>Registrado:</th><td>{{ $factura->created_at->format('d/m/Y H:i') }}</td></tr>
</tbody>
</table>
<div class="d-flex justify-content-between mt-4">
<a href="{{ route('facturas.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
<div>
<a href="{{ route('facturas.edit', $factura) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Editar</a>
<form action="{{ route('facturas.destroy', $factura) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar?');">@csrf @method('DELETE')<button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Eliminar</button></form>
</div></div></div></div></div></div>
@endsection
