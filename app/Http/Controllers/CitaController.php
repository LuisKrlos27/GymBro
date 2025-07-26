<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Empleado;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cita = Cita::all();
        $cliente = Cliente::all();
        $empleado = Empleado::all();

        return view('Citas.CitasIndex', compact('cita','cliente','empleado'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cita = Cita::all();
        $cliente = Cliente::all();
        $empleado = Empleado::whereHas('rol', function ($query) {
            $query->where('nombre', 'Nutricionista');
        })->get();


        return view('Citas.CitasForm', compact('cita','cliente','empleado'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $validated = $request->validate([
            'cliente_id'=>'required|exists:clientes,id',
            'empleado_id'=>'required|exists:empleados,id',
            'fecha'=>'date',
            'descripcion'=>'string|max:100',
        ]);
        Cita::create($validated);
        return redirect()->route('citas.index')->with('success','Cita registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cita $cita)
    {
        $cliente = Cliente::all();
        $empleado = Empleado::all();

        return view('Citas.CitasEdit', compact('cita','cliente','empleado'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cita $cita)
    {
        $validated = $request->validate([
            'cliente_id'=>'required|exists:clientes,id',
            'empleado_id'=>'required|exists:empleados,id',
            'fecha'=>'date',
            'descripcion'=>'string|max:100',
        ]);
        $cita->update($validated);
        return redirect()->route('citas.index')->with('success','Cita actualizada correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('citas.index')->with('success','Cita eliminada correctamente.');

    }
}
