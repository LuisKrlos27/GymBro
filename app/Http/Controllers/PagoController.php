<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Plan;
use App\Models\Cliente;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pago = Pago::all();
        $cliente = Cliente::all();

        return view('Pagos.PagosIndex', compact('pago','cliente'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pago = Pago::all();
        $plan = Plan::all();
        $cliente = Cliente::all();

        return view('Pagos.PagosForm', compact('pago','plan','cliente'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $validated = $request->validate([
            'cliente_id'=>'required|exists:clientes,id',
            'plan_id'=>'required|exists:planes,id',
            'fecha_pago'=>'date',
            'estado'=>'required|boolean'
        ]);
        Plan::create($validated);
        return redirect()->route('pagos.index')->with('success','Pago registrado correctamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago $pago)
    {
        $plan = Plan::all();
        $cliente = Cliente::all();

        return view('Pagos.PagosEdit', compact('plan','pago','cliente'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pago $pago)
    {


        return redirect()->route('pagos.index')->with('success','Pago actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        $pago->delete();

        return redirect()->route('pagos.index')->with('success','Pago eliminado correctamente.');

    }
}
