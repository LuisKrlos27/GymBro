@extends('Home.HomeIndex')
@section('content')

<div class="max-w-3xl mx-auto mt-10 bg-base-100 p-6 rounded shadow">
    <h2 class="text-2xl text-center font-bold mb-6">FACTURA DE PAGO</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Cliente --}}
        <div class="md:col-span-2">
            <label class="label">Cliente</label>
            <input type="text" class="input input-bordered w-full" value="{{ $pago->cliente->nombre }}" disabled>
        </div>

        {{-- Plan --}}
        <div class="md:col-span-2">
            <label class="label">Plan</label>
            <input type="text" class="input input-bordered w-full" value="{{ $pago->plan->nombre }} - ${{ number_format($pago->plan->precio, 0, ',', '.') }}" disabled>
        </div>

        {{-- Fecha --}}
        <div>
            <label class="label">Fecha de pago</label>
            <input type="date" class="input input-bordered w-full" value="{{ $pago->fecha_pago }}" disabled>
        </div>

        {{-- Hora --}}
        <div>
            <label class="label">Hora de pago</label>
            <input type="time" class="input input-bordered w-full" value="{{ $pago->hora_pago }}" disabled>
        </div>

        {{-- Valor total --}}
        <div>
            <label class="label">Valor Total</label>
            <input type="number" class="input input-bordered w-full" value="{{ $pago->valor_total }}" disabled>
        </div>

        {{-- Valor pagado --}}
        <div>
            <label class="label">Valor Pagado</label>
            <input type="number" class="input input-bordered w-full" value="{{ $pago->valor_pagado }}" disabled>
        </div>

        {{-- Cambio --}}
        <div>
            <label class="label">Cambio</label>
            <input type="number" class="input input-bordered w-full" value="{{ $pago->cambio }}" disabled>
        </div>

        {{-- Estado --}}
        <div>
            <label class="label">Estado</label>
            <input type="text" class="input input-bordered w-full" value="{{ $pago->estado ? 'Activo' : 'Inactivo' }}" disabled>
        </div>

        <div class="md:col-span-2 flex justify-center gap-4 pt-4">
            <a href="{{ route('pagos.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
</div>

@endsection
