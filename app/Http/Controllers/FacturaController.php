<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facturas = Factura::with('cliente')->orderBy('created_at', 'desc')->paginate(10);
        return view('facturas.index', compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('facturas.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_factura' => 'required|string|unique:facturas,numero_factura|max:50',
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
            'estado' => 'required|in:pendiente,pagada,cancelada'
        ]);

        Factura::create($validated);

        return redirect()->route('facturas.index')
            ->with('success', 'Factura creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        return view('facturas.show', compact('factura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura)
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('facturas.edit', compact('factura', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factura $factura)
    {
        $validated = $request->validate([
            'numero_factura' => 'required|string|max:50|unique:facturas,numero_factura,' . $factura->id,
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
            'estado' => 'required|in:pendiente,pagada,cancelada'
        ]);

        $factura->update($validated);

        return redirect()->route('facturas.index')
            ->with('success', 'Factura actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        $factura->delete();

        return redirect()->route('facturas.index')
            ->with('success', 'Factura eliminada exitosamente.');
    }
}
