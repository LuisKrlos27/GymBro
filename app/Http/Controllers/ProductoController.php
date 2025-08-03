<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $producto = Producto::all();
        return view('Productos.ProductosIndex',compact('producto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $producto = Producto::all();
        return view('Productos.ProductosForm',compact('producto'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'=>'string|max:50',
            'precio'=>'numeric',
            'cantidad'=>'integer',

        ]);
        Producto::create($validated);
        return redirect()->route('productos.index')->with('success', 'Producto registrado correctamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
