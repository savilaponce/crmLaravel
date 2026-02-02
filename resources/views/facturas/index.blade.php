@extends('layouts.app')
@section('title', 'Facturas')
@section('content')
<div class="d-flex justify-content-between mb-4">
<h2><i class="bi bi-receipt"></i> Gestión de Facturas</h2>
<a href="{{ route('facturas.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Nueva Factura</a>
</div>
<div class="card shadow">
<div class="card-body">
@if($facturas->count() > 0)
<div class="table-responsive">
<table class="table table-hover">
<thead class="table-light"><tr><th>ID</th><th>Núm. Factura</th><th>Cliente</th><th>Fecha</th><th>Total</th><th>Estado</th><th>Acciones</th></tr></thead>
<tbody>
@foreach($facturas as $factura)
<tr>
<td>{{ $factura->id }}</td>
<td><code>{{ $factura->numero_factura }}</code></td>
<td>{{ $factura->cliente->nombre }}</td>
<td>{{ $factura->fecha->format('d/m/Y') }}</td>
<td><strong>{{ number_format($factura->total, 2) }} €</strong></td>
<td>
@if($factura->estado == 'pagada')
<span class="badge bg-success">Pagada</span>
@elseif($factura->estado == 'pendiente')
<span class="badge bg-warning">Pendiente</span>
@else
<span class="badge bg-danger">Cancelada</span>
@endif
</td>
<td>
<div class="btn-group">
<a href="{{ route('facturas.show', $factura) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
<a href="{{ route('facturas.edit', $factura) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
<form action="{{ route('facturas.destroy', $factura) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar?');">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button></form>
</div>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
{{ $facturas->links() }}
@else
<div class="alert alert-info">No hay facturas. <a href="{{ route('facturas.create') }}">Crear primera</a></div>
@endif
</div>
</div>
@endsection
