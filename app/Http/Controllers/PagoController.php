<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'plan_id' => 'required|exists:planes,id',
            'valor_total' => 'required|numeric',
            'valor_pagado' => 'required|numeric|gte:valor_total',
            'estado' => 'required|boolean',
        ]);

        $plan = Plan::findOrFail($validated['plan_id']);

        $validated['cambio'] = $validated['valor_pagado'] - $validated['valor_total'];
        $validated['fecha_pago'] = Carbon::now()->toDateString();// Fecha actual
        $validated['hora_pago'] = Carbon::now()->format('H:i:s');//Hora actual

        // Fecha de vencimiento = fecha_pago + duración del plan
        $fechaPago = Carbon::parse($validated['fecha_pago']);
        $validated['fecha_vencimiento'] = $fechaPago->copy()->addDays($plan->duracion_dias);

        Pago::create($validated);

        return redirect()->route('pagos.index')->with('success', 'Pago registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        return view('Pagos.PagosShow', compact('pago'));
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

        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'plan_id' => 'required|exists:planes,id',
            'fecha_pago' => 'required|date',
            'valor_total' => 'required|numeric',
            'valor_pagado' => 'required|numeric|gte:valor_total',
            'estado' => 'required|boolean',
        ]);

        $validated['cambio'] = $validated['valor_pagado'] - $validated['valor_total'];
        $validated['hora_pago'] = Carbon::now()->format('H:i:s'); // hora actual en formato HH:MM:SS

        $pago->update($validated);

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
