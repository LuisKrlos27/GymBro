<?php

namespace App\Http\Controllers;



use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\DetalleVenta;
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
        //variable total para calcular el total de la venta
        $total = 0;
        //array para crear detalles de la venta por separado
        $detalles = [];

        //Ciclo para recorrer todos los productos y guardarlo en el array detalles
        foreach ($request->productos as $item) {
            $producto = Producto::findOrFail($item['producto_id']);

            if ($producto->cantidad < $item['cantidad']) {
                return redirect()->back()->with('error', "No hay suficiente stock para el producto: {$producto->nombre}");
            }

            $subtotal = $producto->precio * $item['cantidad'];
            $detalles[] = [
                'producto_id' => $producto->id,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $producto->precio,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
        }

        if ($request->valor_pagado < $total) {
            return back()->with('error', 'El valor pagado no cubre el total de la venta.');
        }

        //guarda la venta
        $venta = Venta::create([
            'cliente_id' => $request->cliente_id,
            'fecha' => now(),
            'total' => $total,
            'valor_pagado' => $request->valor_pagado,
            'cambio' => $request->valor_pagado - $total,
        ]);

        // Guardar los detalles y actualizar stock
        foreach ($detalles as $detalle) {
            DetalleVenta::create([
                'venta_id' => $venta->id,
                ...$detalle
            ]);

            $producto = Producto::find($detalle['producto_id']);
            $producto->cantidad -= $detalle['cantidad'];
            $producto->save();


        }
        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        return view('Ventas.VentasShow', compact('venta'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        return view('Ventas.VentasEdit', [
            'venta' => $venta,
            'clientes' => Cliente::all(),
            'productos' => Producto::all()
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'productos' => 'required|array|min:1',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'valor_pagado' => 'required|numeric|min:0',
        ]);

        $venta = Venta::findOrFail($id);

        // Eliminar detalles anteriores
        $venta->detalleVentas()->delete();

        $total = 0;
        $detalles = [];

        // Recalcular total y crear nuevos detalles
        foreach ($request->productos as $item) {
            $producto = Producto::findOrFail($item['producto_id']);
            $cantidad = $item['cantidad'];
            $precio = $producto->precio;
            $subtotal = $precio * $cantidad;

            $total += $subtotal;

            $detalles[] = new DetalleVenta([
                'producto_id' => $producto->id,
                'cantidad' => $cantidad,
                'precio_unitario' => $precio,
                'subtotal' => $subtotal,
            ]);

            //descontar inventario, si lo manejas
            $producto->cantidad -= $cantidad;
            $producto->save();
        }

        // Actualizar venta
        $venta->update([
            'cliente_id' => $request->cliente_id,
            'fecha' => now(),
            'total' => $total,
            'valor_pagado' => $request->valor_pagado,
            'cambio' => $request->valor_pagado - $total,
        ]);

        // Guardar detalles nuevamente
        $venta->detalleVentas()->saveMany($detalles);

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        $venta->delete();
        return redirect()->route('ventas.index')->with('success','Venta eliminada correctamente.');
    }
}
