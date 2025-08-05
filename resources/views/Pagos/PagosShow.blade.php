@extends('Home.HomeIndex')
@section('content')

<div class="max-w-3xl mx-auto mt-10 bg-base-100 p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold text-center text-primary mb-8">FACTURA DE PAGO</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-gray-600 mb-1">Cliente</label>
            <input type="text" class="input input-bordered w-full" value="{{ $pago->cliente->nombre }}" disabled>
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-gray-600 mb-1">Plan</label>
            <input type="text" class="input input-bordered w-full" value="{{ $pago->plan->nombre }} - ${{ number_format($pago->plan->precio, 0, ',', '.') }}" disabled>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1">Fecha de pago</label>
            <input type="date" class="input input-bordered w-full" value="{{ $pago->fecha_pago }}" disabled>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1">Hora de pago</label>
            <input type="time" class="input input-bordered w-full" value="{{ $pago->hora_pago }}" disabled>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1">Fecha de vencimiento</label>
            <input type="date" class="input input-bordered w-full" value="{{ $pago->fecha_vencimiento }}" disabled>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1">Estado</label>
            <input type="text" class="input input-bordered w-full" value="{{ $pago->estado ? 'Activo' : 'Inactivo' }}" disabled>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1">Valor Total</label>
            <input type="number" class="input input-bordered w-full" value="{{ $pago->valor_total }}" disabled>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1">Valor Pagado</label>
            <input type="number" class="input input-bordered w-full" value="{{ $pago->valor_pagado }}" disabled>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1">Cambio</label>
            <input type="number" class="input input-bordered w-full" value="{{ $pago->cambio }}" disabled>
        </div>

        <div class="md:col-span-2 flex justify-center pt-6">
            <a href="{{ route('pagos.index') }}" class="btn btn-primary px-8">Volver</a>
        </div>

    </div>
</div>

@endsection
