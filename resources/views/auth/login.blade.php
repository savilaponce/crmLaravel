<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CRM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .card-header {
            background-color: #3b82f6; /* El mismo azul de tu dashboard */
            color: white;
            text-align: center;
            padding: 1.5rem;
            border-top-left-radius: 0.5rem !important;
            border-top-right-radius: 0.5rem !important;
        }
        .btn-primary {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }
        .btn-primary:hover {
            background-color: #2563eb;
        }
    </style>
</head>
<body>

    <div class="card login-card">
        <div class="card-header">
            <h4 class="mb-0 fw-bold">CRM Acceso</h4>
            <small>Ingresa tus credenciales</small>
        </div>
        <div class="card-body p-4">
            
            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0 small ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf <div class="mb-3">
                    <label for="email" class="form-label text-secondary small fw-bold">CORREO ELECTRÓNICO</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="ejemplo@correo.com">
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label text-secondary small fw-bold">CONTRASEÑA</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="******">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary py-2 fw-medium">
                        Ingresar al Sistema
                    </button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center bg-white border-0 pb-4">
            <small class="text-muted">© {{ date('Y') }} Tu Empresa</small>
        </div>
    </div>

</body>
</html>