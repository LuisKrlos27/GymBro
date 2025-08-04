@extends('Home.HomeIndex')

@section('content')
<div class="relative mb-4">
    <h2 class="text-xl font-bold text-center text-accent">REGISTRAR VENTA</h2>
</div>

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

<form action="{{ route('ventas.store') }}" method="POST" class="space-y-4">
    @csrf

    <!-- Cliente -->
    <div>
        <label for="cliente_id" class="block font-bold mb-1">Cliente</label>
        <select name="cliente_id" id="cliente_id" class="select select-bordered w-full" required>
            <option value="">Seleccione un cliente</option>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
            @endforeach
        </select>
    </div>

    <!-- Productos dinámicos -->
    <div id="productos-container" class="space-y-4">
        <div class="producto-row border p-4 rounded-lg bg-base-200">
            <label class="block font-bold mb-1">Producto</label>
            <select name="productos[0][producto_id]" class="select select-bordered w-full" required>
                <option value="">Seleccione producto</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">
                        {{ $producto->nombre }} - ${{ number_format($producto->precio) }} (Stock: {{ $producto->cantidad }})
                    </option>
                @endforeach
            </select>

            <label class="block font-bold mt-2 mb-1">Cantidad</label>
            <input type="number" name="productos[0][cantidad]" class="input input-bordered w-full" min="1" required>
        </div>
    </div>

    <button type="button" onclick="agregarProducto()" class="btn btn-outline btn-accent">+ Agregar producto</button>

    <!-- Valor pagado -->
    <div>
        <label for="valor_pagado" class="block font-bold mb-1">Valor pagado por el cliente</label>
        <input type="number" name="valor_pagado" id="valor_pagado" class="input input-bordered w-full" min="0" required>
    </div>

    <!-- Botón -->
    <div class="text-center">
        <button type="submit" class="btn btn-primary font-bold">Registrar Venta</button>
    </div>
</form>

<script>
    let index = 1;
    function agregarProducto() {
        const container = document.getElementById('productos-container');
        const row = document.createElement('div');
        row.classList.add('producto-row', 'border', 'p-4', 'rounded-lg', 'bg-base-200');

        row.innerHTML = `
            <label class="block font-bold mb-1">Producto</label>
            <select name="productos[${index}][producto_id]" class="select select-bordered w-full" required>
                <option value="">Seleccione producto</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">
                        {{ $producto->nombre }} - ${{ number_format($producto->precio) }} (Stock: {{ $producto->cantidad }})
                    </option>
                @endforeach
            </select>

            <label class="block font-bold mt-2 mb-1">Cantidad</label>
            <input type="number" name="productos[${index}][cantidad]" class="input input-bordered w-full" min="1" required>
        `;

        container.appendChild(row);
        index++;
    }

    // Desvanecer alertas
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
