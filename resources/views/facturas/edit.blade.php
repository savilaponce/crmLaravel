@extends('layouts.app')

@section('title', 'Editar Factura #' . $factura->numero_factura)

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('facturas.index') }}" class="text-decoration-none">Facturas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar</li>
                </ol>
            </nav>
            <h1 class="h3 text-dark fw-bold mb-0">Modificar Factura</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title fw-bold mb-0 text-primary">
                        <i class="bi bi-pencil-square me-2"></i>Detalles de la Factura
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('facturas.update', $factura) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h6 class="text-uppercase text-muted small fw-bold mb-3">Datos Generales</h6>
                        <div class="row g-4 mb-4">
                            
                            <div class="col-md-6">
                                <label for="numero_factura" class="form-label fw-medium">Número de Factura <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-hash"></i></span>
                                    <input type="text" 
                                           class="form-control border-start-0 @error('numero_factura') is-invalid @enderror" 
                                           id="numero_factura" 
                                           name="numero_factura" 
                                           value="{{ old('numero_factura', $factura->numero_factura) }}" 
                                           required>
                                    @error('numero_factura')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="fecha" class="form-label fw-medium">Fecha de Emisión <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-calendar-date"></i></span>
                                    <input type="date" 
                                           class="form-control border-start-0 @error('fecha') is-invalid @enderror" 
                                           id="fecha" 
                                           name="fecha" 
                                           value="{{ old('fecha', $factura->fecha->format('Y-m-d')) }}" 
                                           required>
                                    @error('fecha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="cliente_id" class="form-label fw-medium">Cliente Asociado <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person-bounding-box"></i></span>
                                <select class="form-select border-start-0 @error('cliente_id') is-invalid @enderror" 
                                        id="cliente_id" 
                                        name="cliente_id" 
                                        required>
                                    <option value="">Seleccione un cliente del listado...</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ old('cliente_id', $factura->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nombre }} (ID: {{ $cliente->id }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('cliente_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text text-muted small ms-2">Si el cliente no aparece, debes registrarlo primero en la sección de Clientes.</div>
                        </div>

                        <hr class="text-muted opacity-10 my-4">

                        <h6 class="text-uppercase text-muted small fw-bold mb-3">Detalles Económicos</h6>
                        <div class="row g-4 mb-4">
                            
                            <div class="col-md-6">
                                <label for="total" class="form-label fw-medium">Importe Total <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-currency-euro"></i></span>
                                    <input type="number" 
                                           step="0.01" 
                                           class="form-control border-start-0 fw-bold text-dark @error('total') is-invalid @enderror" 
                                           id="total" 
                                           name="total" 
                                           placeholder="0.00"
                                           value="{{ old('total', $factura->total) }}" 
                                           required>
                                    @error('total')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="estado" class="form-label fw-medium">Estado del Cobro <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-info-circle"></i></span>
                                    <select class="form-select border-start-0 @error('estado') is-invalid @enderror" 
                                            id="estado" 
                                            name="estado" 
                                            required>
                                        <option value="pendiente" {{ old('estado', $factura->estado) == 'pendiente' ? 'selected' : '' }}>🕒 Pendiente</option>
                                        <option value="pagada" {{ old('estado', $factura->estado) == 'pagada' ? 'selected' : '' }}>✅ Pagada</option>
                                        <option value="cancelada" {{ old('estado', $factura->estado) == 'cancelada' ? 'selected' : '' }}>❌ Cancelada</option>
                                    </select>
                                    @error('estado')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                            <a href="{{ route('facturas.index') }}" class="btn btn-light border">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-check-circle me-2"></i>Guardar Cambios
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection