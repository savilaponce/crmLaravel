-- CRM Laravel - Database Backup
-- Generado: 2024-02-02
-- Base de datos: crm_laravel

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `crm_laravel`
--

CREATE DATABASE IF NOT EXISTS `crm_laravel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `crm_laravel`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` text,
  `empresa` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `email`, `telefono`, `direccion`, `empresa`, `created_at`, `updated_at`) VALUES
(1, 'Juan Pérez', 'juan.perez@email.com', '611223344', 'Calle Mayor 1, Madrid', 'Tech Solutions SL', NOW(), NOW()),
(2, 'María García', 'maria.garcia@email.com', '622334455', 'Avenida Diagonal 100, Barcelona', 'Innovatech SA', NOW(), NOW()),
(3, 'Carlos López', 'carlos.lopez@email.com', '633445566', 'Gran Vía 50, Valencia', 'Digital Spain', NOW(), NOW());

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text,
  `precio` decimal(10,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `sku` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productos_sku_unique` (`sku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `sku`, `created_at`, `updated_at`) VALUES
(1, 'Laptop Dell XPS 13', 'Portátil ultraligero con procesador Intel i7', 1299.99, 15, 'LAP-DELL-001', NOW(), NOW()),
(2, 'Mouse Logitech MX Master', 'Ratón inalámbrico ergonómico', 89.99, 50, 'MOU-LOG-002', NOW(), NOW()),
(3, 'Teclado Mecánico RGB', 'Teclado gaming con switches mecánicos', 149.99, 25, 'TEC-RGB-003', NOW(), NOW()),
(4, 'Monitor LG 27 4K', 'Monitor 27 pulgadas resolución 4K', 499.99, 10, 'MON-LG-004', NOW(), NOW());

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` text,
  `cif` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `proveedores_email_unique` (`email`),
  UNIQUE KEY `proveedores_cif_unique` (`cif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `email`, `telefono`, `direccion`, `cif`, `created_at`, `updated_at`) VALUES
(1, 'Distribuciones Tech SA', 'contacto@disttech.com', '914567890', 'Polígono Industrial Las Mercedes, Madrid', 'B12345678', NOW(), NOW()),
(2, 'Importadora Global SL', 'info@impglobal.com', '935678901', 'Zona Franca, Barcelona', 'B23456789', NOW(), NOW()),
(3, 'Suministros Informáticos', 'ventas@suminfo.com', '963456789', 'Calle Comercio 15, Valencia', 'B34567890', NOW(), NOW());

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `puesto` varchar(255) NOT NULL,
  `salario` decimal(10,2) NOT NULL,
  `fecha_contratacion` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `empleados_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `email`, `telefono`, `puesto`, `salario`, `fecha_contratacion`, `created_at`, `updated_at`) VALUES
(1, 'Ana Martínez', 'ana.martinez@empresa.com', '644556677', 'Desarrolladora Senior', 45000.00, '2022-01-15', NOW(), NOW()),
(2, 'Pedro Sánchez', 'pedro.sanchez@empresa.com', '655667788', 'Diseñador UX/UI', 38000.00, '2022-06-01', NOW(), NOW()),
(3, 'Laura Fernández', 'laura.fernandez@empresa.com', '666778899', 'Project Manager', 50000.00, '2021-03-10', NOW(), NOW()),
(4, 'Miguel Torres', 'miguel.torres@empresa.com', '677889900', 'DevOps Engineer', 48000.00, '2023-02-20', NOW(), NOW());

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `numero_factura` varchar(50) NOT NULL,
  `cliente_id` bigint UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `estado` enum('pendiente','pagada','cancelada') NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `facturas_numero_factura_unique` (`numero_factura`),
  KEY `facturas_cliente_id_foreign` (`cliente_id`),
  CONSTRAINT `facturas_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `numero_factura`, `cliente_id`, `fecha`, `total`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'FAC-2024-001', 1, '2024-01-15', 2599.98, 'pagada', NOW(), NOW()),
(2, 'FAC-2024-002', 2, '2024-01-20', 1789.96, 'pendiente', NOW(), NOW()),
(3, 'FAC-2024-003', 1, '2024-02-01', 499.99, 'pendiente', NOW(), NOW()),
(4, 'FAC-2024-004', 3, '2024-02-02', 3450.50, 'pagada', NOW(), NOW());

-- --------------------------------------------------------

COMMIT;

-- Fin del archivo SQL
