@extends('Home.HomeIndex')
@section('content')

<div class="max-w-3xl mx-auto mt-10 bg-base-100 p-6 rounded shadow">
    <h2 class="text-3xl font-bold text-center text-primary mb-8">REGISTRO DE PAGO / FACTURA</h2>

    <form action="{{ route('pagos.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf

        <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-gray-600 mb-1"">Cliente</label>
            <select name="cliente_id" class="select select-bordered w-full" required>
                <option value="">Seleccione un cliente</option>
                @foreach ($cliente as $cli)
                    <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-gray-600 mb-1"">Plan</label>
            <select id="plan_id" name="plan_id" class="select select-bordered w-full" required>
                <option value="">Seleccione un plan</option>
                @foreach ($plan as $pla)
                    <option value="{{ $pla->id }}" data-precio="{{ $pla->precio }}">
                        {{ $pla->nombre }} - ${{ number_format($pla->precio, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1"">Valor Total</label>
            <input type="number" id="valor_total" name="valor_total" step="0.01" class="input input-bordered w-full" readonly required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1"">Valor Pagado</label>
            <input type="number" id="valor_pagado" name="valor_pagado" step="0.01" class="input input-bordered w-full" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1"">Cambio</label>
            <input type="number" id="cambio" name="cambio" step="0.01" class="input input-bordered w-full" readonly required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1"">Estado</label>
            <select name="estado" class="select select-bordered w-full" required>
                <option value="0">Inactivo</option>
                <option value="1">Activo</option>
            </select>
        </div>

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
