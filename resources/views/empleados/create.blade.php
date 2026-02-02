@extends('layouts.app')

@section('title', 'Alta de Nuevo Empleado')

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('empleados.index') }}" class="text-decoration-none">Empleados</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
                </ol>
            </nav>
            <h1 class="h3 text-dark fw-bold mb-0">Contratación de Personal</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title fw-bold mb-0 text-primary">
                        <i class="bi bi-person-plus-fill me-2"></i>Ficha de Alta
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('empleados.store') }}" method="POST">
                        @csrf

                        <h6 class="text-uppercase text-muted small fw-bold mb-3">Datos Personales y Contacto</h6>
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
                                           placeholder="Ej: Ana García"
                                           required>
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label fw-medium">Correo Corporativo <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope-at"></i></span>
                                    <input type="email" 
                                           class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="empleado@empresa.com"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="telefono" class="form-label fw-medium">Teléfono</label>
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
                        </div>

                        <hr class="text-muted opacity-10 my-4">

                        <h6 class="text-uppercase text-muted small fw-bold mb-3">Información Contractual</h6>
                        <div class="row g-4 mb-4">
                            
                            <div class="col-md-6">
                                <label for="puesto" class="form-label fw-medium">Cargo / Puesto <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-briefcase"></i></span>
                                    <input type="text" 
                                           class="form-control border-start-0 @error('puesto') is-invalid @enderror" 
                                           id="puesto" 
                                           name="puesto" 
                                           placeholder="Ej: Desarrollador Backend"
                                           value="{{ old('puesto') }}" 
                                           required>
                                    @error('puesto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="salario" class="form-label fw-medium">Salario Bruto <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-currency-euro"></i></span>
                                    <input type="number" 
                                           step="0.01" 
                                           class="form-control border-start-0 @error('salario') is-invalid @enderror" 
                                           id="salario" 
                                           name="salario" 
                                           placeholder="0.00"
                                           value="{{ old('salario') }}" 
                                           required>
                                    @error('salario')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="fecha_contratacion" class="form-label fw-medium">Fecha de Ingreso <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-calendar3"></i></span>
                                    <input type="date" 
                                           class="form-control border-start-0 @error('fecha_contratacion') is-invalid @enderror" 
                                           id="fecha_contratacion" 
                                           name="fecha_contratacion" 
                                           value="{{ old('fecha_contratacion') }}" 
                                           required>
                                    @error('fecha_contratacion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                            <a href="{{ route('empleados.index') }}" class="btn btn-light border">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-check-lg me-2"></i>Registrar Empleado
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
