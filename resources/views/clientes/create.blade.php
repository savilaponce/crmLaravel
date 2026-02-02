@extends('layouts.app')

@section('title', 'Registrar Nuevo Cliente')

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}" class="text-decoration-none">Clientes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
                </ol>
            </nav>
            <h1 class="h3 text-dark fw-bold mb-0">Alta de Cliente</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title fw-bold mb-0 text-primary">
                        <i class="bi bi-person-plus me-2"></i>Formulario de Registro
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('clientes.store') }}" method="POST">
                        @csrf

                        <h6 class="text-uppercase text-muted small fw-bold mb-3">Información General</h6>
                        <div class="row g-4 mb-4">
                            
                            <div class="col-md-6">
                                <label for="nombre" class="form-label fw-medium">Nombre Completo <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
                                    <input type="text" 
                                           class="form-control border-start-0 @error('nombre') is-invalid @enderror" 
                                           id="nombre" 
                                           name="nombre" 
                                           value="{{ old('nombre') }}" 
                                           placeholder="Ej: Juan Pérez"
                                           required>
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="empresa" class="form-label fw-medium">Empresa / Organización</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-building"></i></span>
                                    <input type="text" 
                                           class="form-control border-start-0 @error('empresa') is-invalid @enderror" 
                                           id="empresa" 
                                           name="empresa" 
                                           placeholder="Ej: Soluciones Tech S.L."
                                           value="{{ old('empresa') }}">
                                    @error('empresa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="text-muted opacity-10 my-4">

                        <h6 class="text-uppercase text-muted small fw-bold mb-3">Datos de Contacto</h6>
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
                                           placeholder="cliente@ejemplo.com"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="telefono" class="form-label fw-medium">Teléfono Móvil</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-telephone"></i></span>
                                    <input type="text" 
                                           class="form-control border-start-0 @error('telefono') is-invalid @enderror" 
                                           id="telefono" 
                                           name="telefono" 
                                           placeholder="+34 600 000 000"
                                           value="{{ old('telefono') }}">
                                    @error('telefono')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="direccion" class="form-label fw-medium">Dirección Física</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-geo-alt"></i></span>
                                    <textarea class="form-control border-start-0 @error('direccion') is-invalid @enderror" 
                                              id="direccion" 
                                              name="direccion" 
                                              rows="2"
                                              placeholder="Calle Principal, 123, Ciudad...">{{ old('direccion') }}</textarea>
                                    @error('direccion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                            <a href="{{ route('clientes.index') }}" class="btn btn-light border">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-check-lg me-2"></i>Guardar Cliente
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
