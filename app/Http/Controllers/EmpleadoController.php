<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleado = Empleado::all();
        $rol = Rol::all();
        return view('Empleados.EmpleadosIndex', compact('empleado','rol'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rol = Rol::all();
        return view('empleados.empleadosForm', compact('rol'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'=> 'string|max:50',
            'cedula'=>'numeric|unique:empleados,cedula',
            'edad'=>'integer|min:0',
            'celular'=>'numeric',
            'rol_id'=>'required|exists:roles,id',
        ]);
        Empleado::create($validated);
        return redirect()->route('empleados.index')->with('success','Empleado registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {

        $rol = Rol::all();
        return view('Empleados.EmpleadosEdit', compact('empleado','rol'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        $validated = $request->validate([

            'nombre'   => 'string|max:50',
            'cedula'   => 'numeric|unique:empleados,cedula,' . $empleado->id,
            'edad'     => 'integer|min:0',
            'celular'  => 'numeric',
            'rol_id'   => 'required|exists:roles,id',
        ]);

        $empleado->update($validated);
        return redirect()->route('empleados.index')->with('success','Empleado actualizado correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return redirect()->route('empleados.index')->with('success','Empleado eliminado correctamente.');

    }
}
