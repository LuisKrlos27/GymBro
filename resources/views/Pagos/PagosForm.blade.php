@extends('Home.HomeIndex')
@section('content')

<div class="max-w-3xl mx-auto mt-10 bg-base-100 p-6 rounded shadow">
    <h2 class="text-2xl text-center font-bold mb-6">REGISTRO DE PAGO / FACTURA</h2>

    <form action="{{ route('pagos.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf

        {{-- Cliente --}}
        <div class="md:col-span-2">
            <label class="label">Cliente</label>
            <select name="cliente_id" class="select select-bordered w-full" required>
                <option value="">Seleccione un cliente</option>
                @foreach ($cliente as $cli)
                    <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- Plan --}}
        <div class="md:col-span-2">
            <label class="label">Plan</label>
            <select id="plan_id" name="plan_id" class="select select-bordered w-full" required>
                <option value="">Seleccione un plan</option>
                @foreach ($plan as $pla)
                    <option value="{{ $pla->id }}" data-precio="{{ $pla->precio }}">
                        {{ $pla->nombre }} - ${{ number_format($pla->precio, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Fecha --}}
        <div>
            <label class="label">Fecha</label>
            <input type="date" name="fecha_pago" class="input input-bordered w-full" required>
        </div>

        {{-- Hora (se ocultará del usuario, será automática) --}}
        <div>
            <label class="label">Hora</label>
            <input type="time" name="hora_pago" class="input input-bordered w-full" value="{{ now()->format('H:i') }}" readonly>
        </div>

        {{-- Valor Total --}}
        <div>
            <label class="label">Valor Total</label>
            <input type="number" id="valor_total" name="valor_total" step="0.01" class="input input-bordered w-full" readonly required>
        </div>

        {{-- Valor Pagado --}}
        <div>
            <label class="label">Valor Pagado</label>
            <input type="number" id="valor_pagado" name="valor_pagado" step="0.01" class="input input-bordered w-full" required>
        </div>

        {{-- Cambio --}}
        <div>
            <label class="label">Cambio</label>
            <input type="number" id="cambio" name="cambio" step="0.01" class="input input-bordered w-full" readonly required>
        </div>

        {{-- Estado --}}
        <div>
            <label class="label">Estado</label>
            <select name="estado" class="select select-bordered w-full" required>
                <option value="0">Inactivo</option>
                <option value="1">Activo</option>
            </select>
        </div>

        {{-- Botones --}}
        <div class="md:col-span-2 flex justify-center gap-4 pt-4">
            <a href="{{ route('pagos.index') }}" class="btn btn-warning">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>

{<script>
    document.addEventListener('DOMContentLoaded', function () {
        const planSelect = document.getElementById('plan_id');
        const valorTotalInput = document.getElementById('valor_total');
        const valorPagadoInput = document.getElementById('valor_pagado');
        const cambioInput = document.getElementById('cambio');

        // Cuando cambie el plan seleccionado
        planSelect.addEventListener('change', function () {
            const selectedOption = planSelect.options[planSelect.selectedIndex];
            const precio = parseFloat(selectedOption.dataset.precio || 0);
            valorTotalInput.value = precio.toFixed(2);
            calcularCambio();
        });

        // Cuando el usuario escriba el valor pagado
        valorPagadoInput.addEventListener('input', calcularCambio);

        function calcularCambio() {
            const total = parseFloat(valorTotalInput.value) || 0;
            const pagado = parseFloat(valorPagadoInput.value) || 0;
            const cambio = pagado - total;

            // Mostrar 0 si aún no alcanza el valor total
            cambioInput.value = cambio >= 0 ? cambio.toFixed(2) : 0;
        }
    });
</script>


@endsection
