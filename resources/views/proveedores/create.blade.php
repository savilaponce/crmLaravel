@extends('layouts.app')

@section('title', 'Alta de Nuevo Proveedor')

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('proveedores.index') }}" class="text-decoration-none">Proveedores</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
                </ol>
            </nav>
            <h1 class="h3 text-dark fw-bold mb-0">Alta de Proveedor</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title fw-bold mb-0 text-dark">
                        <i class="bi bi-truck me-2 text-warning"></i>Nuevo Socio Comercial
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('proveedores.store') }}" method="POST">
                        @csrf

                        <h6 class="text-uppercase text-muted small fw-bold mb-3">Identificación de la Empresa</h6>
                        <div class="row g-4 mb-4">
                            
                            <div class="col-md-7">
                                <label for="nombre" class="form-label fw-medium">Razón Social / Nombre <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-building"></i></span>
                                    <input type="text" 
                                           class="form-control border-start-0 @error('nombre') is-invalid @enderror" 
                                           id="nombre" 
                                           name="nombre" 
                                           value="{{ old('nombre') }}" 
                                           placeholder="Ej: Logística y Transportes S.L."
                                           required>
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-5">
                                <label for="cif" class="form-label fw-medium">CIF / NIF <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-fingerprint"></i></span>
                                    <input type="text" 
                                           class="form-control border-start-0 font-monospace @error('cif') is-invalid @enderror" 
                                           id="cif" 
                                           name="cif" 
                                           value="{{ old('cif') }}" 
                                           placeholder="B-12345678"
                                           required>
                                    @error('cif')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="text-muted opacity-10 my-4">

                        <h6 class="text-uppercase text-muted small fw-bold mb-3">Información de Contacto</h6>
                        <div class="row g-4 mb-4">
                            
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-medium">Correo Electrónico <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                                    <input type="email" 
                                           class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="contacto@proveedor.com"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="telefono" class="form-label fw-medium">Teléfono de Contacto</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-telephone"></i></span>
                                    <input type="text" 
                                           class="form-control border-start-0 @error('telefono') is-invalid @enderror" 
                                           id="telefono" 
                                           name="telefono" 
                                           placeholder="+34 900 000 000"
                                           value="{{ old('telefono') }}">
                                    @error('telefono')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="direccion" class="form-label fw-medium">Dirección Fiscal / Envío</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-geo-alt"></i></span>
                                    <textarea class="form-control border-start-0 @error('direccion') is-invalid @enderror" 
                                              id="direccion" 
                                              name="direccion" 
                                              rows="2"
                                              placeholder="Calle, Número, Código Postal, Ciudad...">{{ old('direccion') }}</textarea>
                                    @error('direccion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                            <a href="{{ route('proveedores.index') }}" class="btn btn-light border">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning px-4">
                                <i class="bi bi-check-circle me-2"></i>Guardar Proveedor
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
