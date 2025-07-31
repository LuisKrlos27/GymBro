<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plan = Plan::all();

        return view('Planes.PlanesIndex', compact('plan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Planes.PlanesForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validated = $request->validate([
            'nombre'=>'required|string|max:50',
            'duracion_dias'=>'required|integer',
            'precio'=>'required|numeric'
        ]);

        Plan::create($validated);

        return redirect()->route('planes.index')->with('success','Plan registrado correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        return view('Planes.PlanesEdit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        //dd($request->all());
        $validated = $request->validate([
            'nombre'=>'required|string|max:50',
            'duracion_dias'=>'required|integer',
            'precio'=>'required|numeric'
        ]);

        $plan->update($validated);

        return redirect()->route('planes.index')->with('success','Plan actualizado correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
