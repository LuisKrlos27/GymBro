<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cliente = Cliente::all();
        return view('Clientes.ClientesIndex', compact('cliente'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cliente = Cliente::all();
        return view('Clientes.ClientesForm', compact('cliente'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'=>'string|max:50',
            'cedula'=>'numeric|unique:clientes,cedula',
            'edad'=>'integer',
            'celular'=>'integer'
        ]);
        Cliente::create($validated);
        return redirect()->route('clientes.index')->with('success','Clientes registrado correctamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('Clientes.ClientesEdit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //dd($request);

        $validated = $request->validate([
            'nombre'=>'string|max:50',
            'cedula'=>'numeric|unique:clientes,cedula,' . $cliente->id,
            'edad'=>'integer',
            'celular'=>'integer'
        ]);
        $cliente->update($validated);
        return redirect()->route('clientes.index')->with('success','Clientes registrado correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success','Clientes eliminado correctamente.');

    }
}
