@extends('Home.HomeIndex')
@section('content')

<div class="max-w-3xl mx-auto mt-10 bg-base-100 p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold text-center text-primary mb-8">FACTURA DE VENTA</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-gray-600 mb-1">Cliente</label>
            <input type="text" class="input input-bordered w-full" value="{{ $venta->cliente->nombre }}" disabled>
        </div>

        @foreach($venta->detalleVentas as $detalle)
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Producto</label>
                <input type="text" class="input input-bordered w-full" value="{{ $detalle->producto->nombre }}" disabled>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Cantidad</label>
                <input type="text" class="input input-bordered w-full" value="{{ $detalle->cantidad }}" disabled>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Precio unitario</label>
                <input type="text" class="input input-bordered w-full" value="${{ number_format($detalle->precio_unitario) }}" disabled>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Subtotal</label>
                <input type="text" class="input input-bordered w-full" value="${{ number_format($detalle->subtotal, 0, ',', '.') }}" disabled>
            </div>
        @endforeach

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1">Total</label>
            <input type="text" class="input input-bordered w-full" value="${{ number_format($venta->total, 0, ',', '.') }}" disabled>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1">Valor pagado</label>
            <input type="text" class="input input-bordered w-full" value="${{ number_format($venta->valor_pagado, 0, ',', '.') }}" disabled>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1">Cambio</label>
            <input type="text" class="input input-bordered w-full" value="${{ number_format($venta->cambio, 0, ',', '.') }}" disabled>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1">Fecha de venta</label>
            <input type="text" class="input input-bordered w-full" value="{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}" disabled>
        </div>


        <div class="md:col-span-2 flex justify-center pt-6">
            <a href="{{ route('ventas.index') }}" class="btn btn-primary px-8">Volver</a>
        </div>

    </div>
</div>

@endsection
