@extends('Home.HomeIndex')

@section('content')

<div class="max-w-2xl mx-auto mt-10 bg-base-100 p-6 rounded shadow">
    <h2 class="text-2xl text-center font-bold mb-8 text-primary">REGISTRAR VENTA</h2>

    @if (session('success'))
        <div id="success-alert" class="alert alert-success shadow-lg mb-4 transition-opacity duration-500">
            <div>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div id="error-alert" class="alert alert-error shadow-lg mb-4 transition-opacity duration-500">
            <div>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <form action="{{ route('ventas.store') }}" method="POST" class="grid grid-cols-1 gap-6">
        @csrf

        <div>
            <label for="cliente_id" class="block font-semibold mb-1 text-gray-700">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="select select-bordered w-full" required>
                <option value="">Seleccione un cliente</option>
                @foreach ($cliente as $cli)
                    <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Contenedor productos dinámicos -->
        <div id="productos-container" class="space-y-4">
            <div class="producto-row border p-4 rounded-lg bg-base-200">
                <label class="block font-semibold mb-1 text-gray-700">Producto</label>
                <select name="productos[0][producto_id]" class="select select-bordered w-full" required>
                    <option value="">Seleccione producto</option>
                    @foreach ($producto as $pro)
                        <option value="{{ $pro->id }}">
                            {{ $pro->nombre }} - ${{ number_format($pro->precio) }}
                        </option>
                    @endforeach
                </select>

                <label class="block font-semibold mt-4 mb-1 text-gray-700">Cantidad</label>
                <input type="number" name="productos[0][cantidad]" class="input input-bordered w-full" min="1" required>
            </div>
        </div>

        <button type="button" onclick="agregarProducto()" class="btn btn-outline btn-accent w-full md:w-auto">
            + Agregar producto
        </button>

        <div>
            <label for="valor_pagado" class="block font-semibold mb-1 text-gray-700">Valor pagado por el cliente</label>
            <input type="number" name="valor_pagado" id="valor_pagado" class="input input-bordered w-full" min="0" required>
        </div>

        <div class="flex justify-center pt-4">
            <button type="submit" class="btn btn-primary font-bold w-full md:w-auto">Registrar Venta</button>
        </div>
    </form>
</div>

<script>
    let index = 1;

    function agregarProducto() {
        const container = document.getElementById('productos-container');
        const row = document.createElement('div');
        row.classList.add('producto-row', 'border', 'p-4', 'rounded-lg', 'bg-base-200');
        row.setAttribute('data-index', index);

        row.innerHTML = `
            <label class="block font-semibold mb-1 text-gray-700">Producto</label>
            <select name="producto[${index}][producto_id]" class="select select-bordered w-full" required>
                <option value="">Seleccione producto</option>
                @foreach ($producto as $pro)
                    <option value="{{ $pro->id }}">
                        {{ $pro->nombre }} - ${{ number_format($pro->precio) }}
                    </option>
                @endforeach
            </select>

            <label class="block font-semibold mt-4 mb-1 text-gray-700">Cantidad</label>
            <input type="number" name="productos[${index}][cantidad]" class="input input-bordered w-full" min="1" required>

            <button type="button" onclick="eliminarProducto(this)" class="btn btn-error btn-sm mt-4 w-full md:w-auto">
                Eliminar producto
            </button>
        `;

        container.appendChild(row);
        index++;
    }

    function eliminarProducto(button) {
        const row = button.closest('.producto-row');
        if (row) {
            row.remove();
        }
    }

    // Desvanecer alertas automáticamente
    setTimeout(() => {
        const success = document.getElementById('success-alert');
        const error = document.getElementById('error-alert');
        if (success) {
            success.style.opacity = '0';
            setTimeout(() => success.remove(), 500);
        }
        if (error) {
            error.style.opacity = '0';
            setTimeout(() => error.remove(), 500);
        }
    }, 3000);
</script>

@endsection
