<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Asistencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Inicia la consulta con la relación del cliente
        $query = Asistencia::with('cliente')->orderByDesc('fecha_asistencia');

        // Filtro por nombre del cliente
        if ($request->filled('cliente')) {
            $query->whereHas('cliente', function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->cliente . '%');
            });
        }

        // Filtro por fecha exacta (solo la fecha sin considerar hora)
        if ($request->filled('fecha')) {
            $query->whereDate('fecha_asistencia', $request->fecha);
        }

        $asistencia = $query->get();

        return view('Asistencias.AsistenciasIndex', compact('asistencia'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtiene todos los clientes para poder mostrarlos en el formulario (en un select)
        $cliente = Cliente::all();

        // Retorna la vista 'Asistencias.AsistenciasForm' y le pasa los clientes disponibles
        return view('Asistencias.AsistenciasForm', compact('cliente'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida que el campo cliente_id esté presente y exista en la tabla clientes
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        // Crea una nueva asistencia con el ID del cliente.
        // La fecha y hora se agrega automáticamente por el modelo o migración.
        Asistencia::create([
            'cliente_id' => $request->cliente_id,
        ]);

        // Redirige a la vista de asistencias con un mensaje de éxito
        return redirect()->route('asistencias.index')->with('success', 'Asistencia registrada correctamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Asistencia $asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asistencia $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asistencia $asistencia)
    {
        $asistencia->delete();

        return redirect()->route('asistencias.index')->with('success','Asistencia correctamente eliminada.');
    }
}
