@extends('layouts.app')

@section('title', 'Detalle Cliente - CRM Laravel')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0"><i class="bi bi-person"></i> Detalle del Cliente</h4>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th width="200">ID:</th>
                            <td>{{ $cliente->id }}</td>
                        </tr>
                        <tr>
                            <th>Nombre:</th>
                            <td>{{ $cliente->nombre }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $cliente->email }}</td>
                        </tr>
                        <tr>
                            <th>Teléfono:</th>
                            <td>{{ $cliente->telefono ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Dirección:</th>
                            <td>{{ $cliente->direccion ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Empresa:</th>
                            <td>{{ $cliente->empresa ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Fecha de Registro:</th>
                            <td>{{ $cliente->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Última Actualización:</th>
                            <td>{{ $cliente->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                    <div>
                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form action="{{ route('clientes.destroy', $cliente) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('¿Está seguro de eliminar este cliente?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
