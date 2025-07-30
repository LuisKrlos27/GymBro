@extends('Home.HomeIndex')
@section('content')

<div class="max-w-3xl mx-auto mt-10 bg-base-100 p-6 rounded shadow">
    <h2 class="text-2xl text-center font-bold mb-6">EDITAR PAGO / FACTURA</h2>

    <form action="{{ route('pagos.update', $pago->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf
        @method('PUT')

        {{-- Cliente --}}
        <div class="md:col-span-2">
            <label class="label">Cliente</label>
            <select name="cliente_id" class="select select-bordered w-full" required>
                <option value="">Seleccione un cliente</option>
                @foreach ($cliente as $cli)
                    <option value="{{ $cli->id }}" {{ $cli->id == $pago->cliente_id ? 'selected' : '' }}>
                        {{ $cli->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Plan --}}
        <div class="md:col-span-2">
            <label class="label">Plan</label>
            <select id="plan_id" name="plan_id" class="select select-bordered w-full" required>
                <option value="">Seleccione un plan</option>
                @foreach ($plan as $pla)
                    <option value="{{ $pla->id }}" data-precio="{{ $pla->precio }}" {{ $pla->id == $pago->plan_id ? 'selected' : '' }}>
                        {{ $pla->nombre }} - ${{ number_format($pla->precio, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Fecha --}}
        <div>
            <label class="label">Fecha</label>
            <input type="date" name="fecha_pago" value="{{ $pago->fecha_pago }}" class="input input-bordered w-full" required>
        </div>

        {{-- Hora --}}
        <div>
            <label class="label">Hora</label>
            <input type="time" name="hora_pago" value="{{ $pago->hora_pago }}" class="input input-bordered w-full" readonly>
        </div>

        {{-- Valor Total --}}
        <div>
            <label class="label">Valor Total</label>
            <input type="number" id="valor_total" name="valor_total" value="{{ $pago->valor_total }}" step="0.01" class="input input-bordered w-full" readonly required>
        </div>

        {{-- Valor Pagado --}}
        <div>
            <label class="label">Valor Pagado</label>
            <input type="number" id="valor_pagado" name="valor_pagado" value="{{ $pago->valor_pagado }}" step="0.01" class="input input-bordered w-full" required>
        </div>

        {{-- Cambio --}}
        <div>
            <label class="label">Cambio</label>
            <input type="number" id="cambio" name="cambio" value="{{ $pago->cambio }}" step="0.01" class="input input-bordered w-full" readonly required>
        </div>

        {{-- Estado --}}
        <div>
            <label class="label">Estado</label>
            <select name="estado" class="select select-bordered w-full" required>
                <option value="0" {{ $pago->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                <option value="1" {{ $pago->estado == 1 ? 'selected' : '' }}>Activo</option>
            </select>
        </div>

        {{-- Botones --}}
        <div class="md:col-span-2 flex justify-center gap-4 pt-4">
            <a href="{{ route('pagos.index') }}" class="btn btn-warning">Cancelar</a>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
</div>

{{-- Script para cargar precio y calcular cambio --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const planSelect = document.getElementById('plan_id');
        const valorTotalInput = document.getElementById('valor_total');
        const valorPagadoInput = document.getElementById('valor_pagado');
        const cambioInput = document.getElementById('cambio');

        planSelect.addEventListener('change', function () {
            const selectedOption = planSelect.options[planSelect.selectedIndex];
            const precio = selectedOption.getAttribute('data-precio');
            valorTotalInput.value = precio ? parseFloat(precio).toFixed(2) : '';
            calcularCambio();
        });

        valorPagadoInput.addEventListener('input', calcularCambio);

        function calcularCambio() {
            const total = parseFloat(valorTotalInput.value) || 0;
            const pagado = parseFloat(valorPagadoInput.value) || 0;
            const cambio = pagado - total;
            cambioInput.value = cambio >= 0 ? cambio.toFixed(2) : 0;
        }

        // Ejecutar una vez al cargar por si ya hay valores cargados
        calcularCambio();
    });
</script>

@endsection
