@extends('layouts.app')

@section('title', 'Alta de Nuevo Producto')

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('productos.index') }}" class="text-decoration-none">Productos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
                </ol>
            </nav>
            <h1 class="h3 text-dark fw-bold mb-0">Registro de Producto</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title fw-bold mb-0 text-success">
                        <i class="bi bi-box-seam me-2"></i>Nueva Referencia
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <h6 class="text-uppercase text-muted small fw-bold mb-3">Datos de Identificación</h6>
                        <div class="row g-4 mb-4">
                            <div class="col-md-8">
                                <label for="nombre" class="form-label fw-medium">Nombre del Producto <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-tag"></i></span>
                                    <input type="text" class="form-control border-start-0 @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="Ej: Laptop HP Pavilion 15" required>
                                    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="sku" class="form-label fw-medium">Código SKU <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-barcode"></i></span>
                                    <input type="text" class="form-control border-start-0 font-monospace @error('sku') is-invalid @enderror" id="sku" name="sku" value="{{ old('sku') }}" placeholder="HP-LPT-001" required>
                                    @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="descripcion" class="form-label fw-medium">Descripción</label>
                                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3" placeholder="Características principales...">{{ old('descripcion') }}</textarea>
                                @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <hr class="text-muted opacity-10 my-4">

                        <h6 class="text-uppercase text-muted small fw-bold mb-3">Multimedia</h6>
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="imagen" class="form-label fw-medium">Imagen del Producto</label>
                                <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen" accept="image/*">
                                <div class="form-text small">Formatos: JPG, PNG. Máx 2MB.</div>
                                @error('imagen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="ficha_tecnica" class="form-label fw-medium">Ficha Técnica (PDF)</label>
                                <input type="file" class="form-control @error('ficha_tecnica') is-invalid @enderror" id="ficha_tecnica" name="ficha_tecnica" accept=".pdf">
                                <div class="form-text small">Solo archivos PDF. Máx 10MB.</div>
                                @error('ficha_tecnica') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <hr class="text-muted opacity-10 my-4">

                        <h6 class="text-uppercase text-muted small fw-bold mb-3">Logística y Precio</h6>
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="precio" class="form-label fw-medium">Precio de Venta <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-currency-euro"></i></span>
                                    <input type="number" step="0.01" min="0" class="form-control border-start-0 @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio') }}" required>
                                    @error('precio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="stock" class="form-label fw-medium">Stock Inicial <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-layers"></i></span>
                                    <input type="number" min="0" class="form-control border-start-0 @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', 0) }}" required>
                                    @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                            <a href="{{ route('productos.index') }}" class="btn btn-light border">Cancelar</a>
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-check-lg me-2"></i>Guardar Producto
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection