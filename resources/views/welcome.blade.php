@extends('layouts.app')

@section('title', 'Dashboard - CRM Laravel Samuel Ávila Ponce')

@section('content')
<style>
    /* Pequeño CSS para dar efecto de "elevación" a las tarjetas */
    .hover-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
    .icon-box {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }
</style>

<div class="container-fluid py-4">
    <div class="row mb-5">
        <div class="col-12">
            <div class="p-5 rounded-3 text-white bg-primary shadow-sm" style="background: linear-gradient(45deg, #0d6efd, #0dcaf0);">
                <h1 class="display-5 fw-bold"><i class="bi bi-speedometer2"></i> Panel de Control</h1>
                <p class="col-md-8 fs-4">Sistema de Gestión Empresarial de Samuel Ávila Ponce</p>
                <p class="mb-0 opacity-75">Resumen general de la actividad de la empresa.</p>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm hover-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="text-muted text-uppercase small fw-bold">Clientes</span>
                            <h2 class="mb-0 fw-bold text-dark">{{ \App\Models\Cliente::count() }}</h2>
                        </div>
                        <div class="icon-box bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-people fs-4"></i>
                        </div>
                    </div>
                    <a href="{{ route('clientes.index') }}" class="text-primary text-decoration-none small fw-bold">
                        Ver listado <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm hover-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="text-muted text-uppercase small fw-bold">Productos</span>
                            <h2 class="mb-0 fw-bold text-dark">{{ \App\Models\Producto::count() }}</h2>
                        </div>
                        <div class="icon-box bg-success bg-opacity-10 text-success">
                            <i class="bi bi-box-seam fs-4"></i>
                        </div>
                    </div>
                    <a href="{{ route('productos.index') }}" class="text-success text-decoration-none small fw-bold">
                        Inventario <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm hover-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="text-muted text-uppercase small fw-bold">Proveedores</span>
                            <h2 class="mb-0 fw-bold text-dark">{{ \App\Models\Proveedor::count() }}</h2>
                        </div>
                        <div class="icon-box bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-truck fs-4"></i>
                        </div>
                    </div>
                    <a href="{{ route('proveedores.index') }}" class="text-warning text-decoration-none small fw-bold">
                        Gestionar <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm hover-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="text-muted text-uppercase small fw-bold">Empleados</span>
                            <h2 class="mb-0 fw-bold text-dark">{{ \App\Models\Empleado::count() }}</h2>
                        </div>
                        <div class="icon-box bg-danger bg-opacity-10 text-danger">
                            <i class="bi bi-person-badge fs-4"></i>
                        </div>
                    </div>
                    <a href="{{ route('empleados.index') }}" class="text-danger text-decoration-none small fw-bold">
                        Personal <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-secondary"><i class="bi bi-receipt me-2"></i>Facturación Reciente</h5>
                    <span class="badge bg-light text-dark border">Total: {{ \App\Models\Factura::count() }}</span>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="alert alert-light border d-flex align-items-center" role="alert">
                        <i class="bi bi-info-circle-fill text-primary me-3 fs-4"></i>
                        <div>
                            Gestión rápida de documentos fiscales. Puedes crear nuevas facturas o revisar el historial completo.
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('facturas.index') }}" class="btn btn-primary px-4">
                            <i class="bi bi-eye me-2"></i>Ver Historial
                        </a>
                        <a href="{{ route('facturas.create') }}" class="btn btn-outline-primary px-4">
                            <i class="bi bi-plus-lg me-2"></i>Nueva Factura
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h5 class="mb-0 fw-bold text-secondary"><i class="bi bi-lightning-charge me-2"></i>Acciones Rápidas</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-3">
                        <a href="{{ route('clientes.create') }}" class="btn btn-light border text-start p-3 hover-card d-flex align-items-center">
                            <div class="icon-box bg-primary text-white me-3" style="width: 35px; height: 35px;">
                                <i class="bi bi-person-plus"></i>
                            </div>
                            <span class="fw-semibold">Registrar Nuevo Cliente</span>
                        </a>
                        
                        <a href="{{ route('productos.create') }}" class="btn btn-light border text-start p-3 hover-card d-flex align-items-center">
                            <div class="icon-box bg-success text-white me-3" style="width: 35px; height: 35px;">
                                <i class="bi bi-box"></i>
                            </div>
                            <span class="fw-semibold">Añadir Producto al Stock</span>
                        </a>

                        <a href="{{ route('empleados.create') }}" class="btn btn-light border text-start p-3 hover-card d-flex align-items-center">
                            <div class="icon-box bg-danger text-white me-3" style="width: 35px; height: 35px;">
                                <i class="bi bi-person-badge-fill"></i>
                            </div>
                            <span class="fw-semibold">Contratar Empleado</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection