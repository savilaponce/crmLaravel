<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'CRM Laravel')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #1e293b;
            --sidebar-color: #cbd5e1;
            --primary-color: #3b82f6;
            --primary-hover: #2563eb;
            --bg-body: #f3f4f6;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            min-height: 100vh;
        }

        /* --- Sidebar Styling --- */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            padding: 1.5rem 1rem;
            transition: all 0.3s;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 2.5rem;
            padding-left: 0.5rem;
        }

        .nav-link {
            color: var(--sidebar-color);
            padding: 0.8rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .nav-link.active {
            background: linear-gradient(90deg, var(--primary-color), var(--primary-hover));
            color: white;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.3);
        }

        .nav-link i {
            font-size: 1.1rem;
        }

        /* --- Main Content & Navbar --- */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top-navbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .content-area {
            padding: 2rem;
            flex: 1;
        }

        /* Alerts Styling */
        .alert {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        /* Responsive Mobile */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-wrapper {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>

    @yield('css') 
</head>
<body>

    <nav class="sidebar" id="sidebar">
        <a href="{{ route('home') }}" class="sidebar-brand">
            <i class="bi bi-grid-1x2-fill text-primary"></i> 
            <span>CRM Panel</span>
        </a>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                    <i class="bi bi-speedometer2"></i> Inicio
                </a>
            </li>
            
            <li class="nav-header text-uppercase small fw-bold mt-3 mb-2 px-2" style="color: #64748b; font-size: 0.75rem;">Gestión</li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('clientes*') ? 'active' : '' }}" href="{{ route('clientes.index') }}">
                    <i class="bi bi-people"></i> Clientes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('productos*') ? 'active' : '' }}" href="{{ route('productos.index') }}">
                    <i class="bi bi-box-seam"></i> Productos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('proveedores*') ? 'active' : '' }}" href="{{ route('proveedores.index') }}">
                    <i class="bi bi-truck"></i> Proveedores
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('empleados*') ? 'active' : '' }}" href="{{ route('empleados.index') }}">
                    <i class="bi bi-person-vcard"></i> Empleados
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('facturas*') ? 'active' : '' }}" href="{{ route('facturas.index') }}">
                    <i class="bi bi-receipt"></i> Facturas
                </a>
            </li>
        </ul>
    </nav>

    <div class="main-wrapper">
        
        <header class="top-navbar">
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-secondary d-md-none me-3" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
                <h5 class="m-0 fw-bold text-secondary">@yield('title', 'Dashboard')</h5>
            </div>

            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" id="userDropdown" data-bs-toggle="dropdown">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                    <span class="d-none d-md-block fw-medium">
                        {{ Auth::user()->name ?? 'Usuario' }}
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>Salir
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </header>

        <main class="content-area">
            
            @if(session('success'))
                <div class="alert alert-success bg-success bg-opacity-10 text-success border-success border-opacity-25 alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger bg-danger bg-opacity-10 text-danger border-danger border-opacity-25 alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-warning bg-warning bg-opacity-10 text-warning border-warning border-opacity-25 alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
            
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script simple para el toggle del sidebar en móviles
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
    </script>

    @yield('scripts')
</body>
</html>