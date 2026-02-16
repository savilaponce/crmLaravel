CRM Laravel - Sistema de Gestión Empresarial

Descripción del Proyecto

Este es un CRM (Customer Relationship Management) desarrollado en Laravel 10 que permite gestionar la información básica de una empresa. A diferencia de un CRUD simple, esta versión cuenta con un sistema de autenticación completo, gestión de roles (Administrador y Usuario) y capacidad para gestionar archivos multimedia (imágenes y documentos PDF).

El sistema incluye 5 módulos principales:

Clientes - Gestión de clientes de la empresa.

Productos - Catálogo con imágenes, fichas técnicas y control de stock visual.

Proveedores - Gestión de proveedores.

Empleados - Administración del personal.

Facturas - Control de facturas emitidas.

Características Principales

Autenticación de usuarios (Login y Registro).

Sistema de Roles y Permisos:

Administrador: Acceso total (puede eliminar registros).

Usuario: Acceso limitado (solo ver y editar, no puede eliminar).

Subida y gestión de archivos (Imágenes y PDFs para productos).

Validación de datos tanto en cliente como en servidor.

Interfaz responsive utilizando Bootstrap 5.

Integración con DataTables para búsqueda y paginación en tiempo real.

Base de datos MySQL.

Requisitos del Sistema

Para ejecutar este proyecto necesitas tener instalado:

PHP >= 8.1

Composer

MySQL / MariaDB

Git

Node.js & NPM (opcional, para compilación de assets)

Pasos de Instalación

1. Clonar el Repositorio

git clone [URL_DE_TU_REPOSITORIO]
cd crm-laravel


2. Instalar Dependencias PHP

composer install


3. Configurar el Archivo .env

Copia el archivo de configuración de ejemplo:

cp .env.example .env


Edita el archivo .env con tus credenciales de base de datos:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crm_laravel
DB_USERNAME=root
DB_PASSWORD=


4. Generar la Clave de Aplicación

php artisan key:generate


5. Configurar el Almacenamiento (Importante)

Para que las imágenes y los PDFs de los productos sean visibles, es obligatorio crear el enlace simbólico:

php artisan storage:link


6. Base de Datos y Semillas

Crea las tablas e inserta los usuarios de prueba:

php artisan migrate:fresh --seed


7. Iniciar el Servidor

php artisan serve


Accede a la aplicación en: http://localhost:8000

Usuarios de Prueba

El sistema requiere autenticación. Se han generado los siguientes usuarios mediante los seeders (o puedes crearlos manualmente con Tinker):

Rol

Email

Contraseña

Permisos

Administrador

admin@admin.com

password

Crear, Leer, Actualizar, Eliminar

Usuario

user@user.com

password

Crear, Leer, Actualizar

Estructura de Módulos

Clientes

Campos: Nombre, Email, Teléfono, Dirección, Empresa.

Funcionalidad: Gestión básica de agenda.

Productos

Campos: Nombre, SKU, Descripción, Precio, Stock, Imagen, Ficha Técnica (PDF).

Funcionalidad:

Carga de imágenes con previsualización.

Subida de PDF para fichas técnicas.

El botón de eliminar solo es visible para el Administrador.

Indicadores visuales de stock bajo.

Proveedores

Campos: Nombre, Email, Teléfono, Dirección, CIF.

Empleados

Campos: Nombre, Email, Teléfono, Puesto, Salario, Fecha de Contratación.

Facturas

Campos: Número de Factura, Cliente, Fecha, Total, Estado.

Comandos Útiles

# Crear el enlace simbólico para imágenes (si da error 404)
php artisan storage:link

# Limpiar caché de configuración
php artisan optimize:clear

# Restaurar base de datos desde cero
php artisan migrate:fresh --seed

# Crear un nuevo controlador
php artisan make:controller NombreController --resource


Tecnologías Utilizadas

Framework: Laravel 10

Seguridad: Laravel Breeze (o implementación manual Auth)

Frontend: Bootstrap 5, Blade Templates, DataTables

Base de Datos: MySQL

PHP: 8.1+

Autor

Proyecto desarrollado para la asignatura de Desarrollo Web con Laravel por Samuel Ávila Ponce.