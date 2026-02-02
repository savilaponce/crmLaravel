<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\FacturaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ruta principal - Dashboard
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas de Clientes
Route::resource('clientes', ClienteController::class);

// Rutas de Productos
Route::resource('productos', ProductoController::class);

// Rutas de Proveedores
Route::resource('proveedores', ProveedorController::class);

// Rutas de Empleados
Route::resource('empleados', EmpleadoController::class);

// Rutas de Facturas
Route::resource('facturas', FacturaController::class);
