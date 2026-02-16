<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\FacturaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTAS DE AUTENTICACIÓN (Login y Logout) ---
// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout (Esta es la ruta que te faltaba y causaba el error)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- RUTAS PROTEGIDAS (Solo accesibles si estás logueado) ---
Route::middleware('auth')->group(function () {

    // Ruta principal - Dashboard
    Route::get('/', function () {
        return view('welcome'); // O cambia 'welcome' por tu vista de dashboard
    })->name('home');

    // Rutas de Recursos (CRUDs completos)
    Route::resource('clientes', ClienteController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('proveedores', ProveedorController::class);
    Route::resource('empleados', EmpleadoController::class);
    Route::resource('facturas', FacturaController::class);

});