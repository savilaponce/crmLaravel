<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Necesario para borrar/gestionar archivos
use Illuminate\Support\Facades\Auth;    // Necesario para verificar roles

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Usamos get() para que DataTables maneje la paginación en el front
        $productos = Producto::orderBy('created_at', 'desc')->get();
        
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validamos datos + archivos
        // IMPORTANTE: Aquí cambiamos archivo_pdf por ficha_tecnica
        $validated = $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'sku'         => 'required|string|unique:productos,sku|max:50',
            'imagen'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Máx 2MB
            'ficha_tecnica' => 'nullable|mimes:pdf|max:10000', // Máx 10MB
        ]);

        // 2. Gestión de subida de Imagen
        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        // 3. Gestión de subida de PDF (CORREGIDO)
        // Usamos 'ficha_tecnica' en lugar de 'archivo_pdf'
        if ($request->hasFile('ficha_tecnica')) {
            $validated['ficha_tecnica'] = $request->file('ficha_tecnica')->store('fichas_tecnicas', 'public');
        }

        Producto::create($validated);

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        // Validación CORREGIDA: archivo_pdf -> ficha_tecnica
        $validated = $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'sku'         => 'required|string|max:50|unique:productos,sku,' . $producto->id,
            'imagen'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ficha_tecnica' => 'nullable|mimes:pdf|max:10000',
        ]);

        // 1. Si suben nueva imagen
        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $validated['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        // 2. Si suben nuevo PDF (CORREGIDO)
        if ($request->hasFile('ficha_tecnica')) {
            // Borrar antiguo si existe (usando el nombre correcto de la columna)
            if ($producto->ficha_tecnica) {
                Storage::disk('public')->delete($producto->ficha_tecnica);
            }
            // Guardar nuevo
            $validated['ficha_tecnica'] = $request->file('ficha_tecnica')->store('fichas_tecnicas', 'public');
        }

        $producto->update($validated);

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        // 1. CONTROL DE ROLES
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('productos.index')
                ->with('error', 'Acceso denegado. Solo los administradores pueden borrar productos.');
        }

        // 2. Borrar archivos físicos
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

        // CORREGIDO: Usar ficha_tecnica
        if ($producto->ficha_tecnica) {
            Storage::disk('public')->delete($producto->ficha_tecnica);
        }

        // 3. Borrar registro
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }
}