<?php

namespace App\Http\Controllers;



use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $venta = Venta::all();
        $producto = Producto::all();

        return view('Ventas.VentasIndex', compact('venta','producto'));

    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cliente = Cliente::all();
        $producto = Producto::all();

        return view('Ventas.VentasForm', compact('cliente', 'producto'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'productos' => 'required|array|min:1',
        'productos.*.producto_id' => 'required|exists:productos,id',
        'productos.*.cantidad' => 'required|integer|min:1',
        'valor_pagado' => 'required|numeric|min:0',
        ]);

        $total = 0;
        $detalles = [];

        foreach ($request->productos as $item) {
            $producto = Producto::find($item['producto_id']);

            if (!$producto) {
                return redirect()->back()->with('error', 'Producto no encontrado.');
            }

            if ($producto->cantidad < $item['cantidad']) {
                return redirect()->back()->with('error', 'No hay suficiente stock para el producto: ' . $producto->nombre);
            }

            $subtotal = $producto->precio * $item['cantidad'];
            $total += $subtotal;

            $detalles[] = [
                'producto_id' => $producto->id,
                'nombre' => $producto->nombre,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $producto->precio,
                'subtotal' => $subtotal,
            ];
        }

        if ($request->valor_pagado < $total) {
            return redirect()->back()->with('error', 'El valor pagado no cubre el total de la venta.');
        }

        // Guardar venta
        Venta::create([
            'cliente_id' => $request->cliente_id,
            'fecha' => now(),
            'total' => $total,
            'detalles_json' => $detalles,
        ]);

        // Reducir stock
        foreach ($request->productos as $item) {
            $producto = Producto::find($item['producto_id']);
            $producto->cantidad -= $item['cantidad'];
            $producto->save();
        }

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
    }




    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
