# CRM Laravel - Sistema de Gestión Empresarial

## Descripción del Proyecto

Este es un CRM (Customer Relationship Management) desarrollado en Laravel 10 que permite gestionar la información básica de una empresa. El sistema incluye 5 módulos CRUD completos:

1. **Clientes** - Gestión de clientes de la empresa
2. **Productos** - Catálogo de productos
3. **Proveedores** - Gestión de proveedores
4. **Empleados** - Administración del personal
5. **Facturas** - Control de facturas emitidas

## Características Principales

-  CRUD completo para cada módulo
-  Navegación intuitiva entre módulos
-  Interfaz responsive con Bootstrap 5
-  Validación de datos
-  Mensajes de confirmación
-  Base de datos MySQL

## Requisitos del Sistema

Para ejecutar este proyecto necesitas tener instalado:

- PHP >= 8.1
- Composer
- MySQL / MariaDB
- XAMPP o servidor local similar
- Git

## Pasos de Instalación

### 1. Clonar el Repositorio

```bash
git clone [URL_DE_TU_REPOSITORIO]
cd crm-laravel
```

### 2. Instalar Dependencias

```bash
composer install
```

### 3. Configurar el Archivo .env

Copia el archivo `.env.example` a `.env`:

```bash
cp .env.example .env
```

Edita el archivo `.env` con tus credenciales de base de datos:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crm_laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generar la Clave de Aplicación

```bash
php artisan key:generate
```

### 5. Crear la Base de Datos

Crea una base de datos llamada `crm_laravel` en MySQL:

```sql
CREATE DATABASE crm_laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

O importa el archivo SQL proporcionado:

```bash
mysql -u root -p crm_laravel < database/crm_laravel.sql
```

### 6. Ejecutar las Migraciones

```bash
php artisan migrate
```

Si quieres datos de prueba:

```bash
php artisan migrate:fresh --seed
```

### 7. Iniciar el Servidor

```bash
php artisan serve
```

Accede a la aplicación en: `http://localhost:8000`

## Estructura de Módulos

### Clientes
- **Campos**: Nombre, Email, Teléfono, Dirección, Empresa
- **Ruta**: `/clientes`

### Productos
- **Campos**: Nombre, Descripción, Precio, Stock, SKU
- **Ruta**: `/productos`

### Proveedores
- **Campos**: Nombre, Email, Teléfono, Dirección, CIF
- **Ruta**: `/proveedores`

### Empleados
- **Campos**: Nombre, Email, Teléfono, Puesto, Salario, Fecha de Contratación
- **Ruta**: `/empleados`

### Facturas
- **Campos**: Número de Factura, Cliente, Fecha, Total, Estado
- **Ruta**: `/facturas`

## Usuarios de Prueba

El sistema no requiere autenticación en esta versión, por lo que puedes acceder directamente a todos los módulos.

## Estructura del Proyecto

```
crm-laravel/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── ClienteController.php
│   │       ├── ProductoController.php
│   │       ├── ProveedorController.php
│   │       ├── EmpleadoController.php
│   │       └── FacturaController.php
│   └── Models/
│       ├── Cliente.php
│       ├── Producto.php
│       ├── Proveedor.php
│       ├── Empleado.php
│       └── Factura.php
├── database/
│   ├── migrations/
│   └── crm_laravel.sql
├── resources/
│   └── views/
│       ├── layouts/
│       ├── clientes/
│       ├── productos/
│       ├── proveedores/
│       ├── empleados/
│       └── facturas/
└── routes/
    └── web.php
```

## Comandos Útiles

```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Ver rutas
php artisan route:list

# Crear migración
php artisan make:migration create_table_name

# Crear modelo
php artisan make:model ModelName

# Crear controlador
php artisan make:controller ControllerName
```

## Tecnologías Utilizadas

- **Framework**: Laravel 10
- **Frontend**: Bootstrap 5, Blade Templates
- **Base de Datos**: MySQL
- **PHP**: 8.1+

## Autor

Proyecto desarrollado para la asignatura de Desarrollo Web con Laravel.

## Licencia

Este proyecto es de código abierto y está disponible bajo la licencia MIT.

---

**Nota**: Este es un proyecto educativo desarrollado con fines de aprendizaje.
