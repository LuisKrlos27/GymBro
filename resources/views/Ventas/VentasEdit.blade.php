@extends('Home.HomeIndex')

@section('content')

<div class="max-w-3xl mx-auto mt-10 bg-base-100 p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold text-center text-primary mb-8">EDITAR VENTA</h2>

    <form action="{{ route('ventas.update', $venta->id) }}" method="POST" class="grid grid-cols-1 gap-6">
        @csrf
        @method('PUT')

        {{-- Cliente --}}
        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1">Cliente</label>
            <select name="cliente_id" class="select select-bordered w-full" required>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $cliente->id == $venta->cliente_id ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Productos dinámicos --}}
        <div id="productos-container" class="space-y-4">
            @foreach($venta->detalleVentas as $i => $detalle)
                <div class="producto-row border p-4 rounded-lg bg-base-200">
                    <label class="block font-semibold mb-1 text-gray-700">Producto</label>
                    <select name="productos[{{ $i }}][producto_id]" class="select select-bordered w-full" required>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}" {{ $producto->id == $detalle->producto_id ? 'selected' : '' }}>
                                {{ $producto->nombre }} - ${{ number_format($producto->precio) }}
                            </option>
                        @endforeach
                    </select>

                    <label class="block font-semibold mt-4 mb-1 text-gray-700">Cantidad</label>
                    <input type="number" name="productos[{{ $i }}][cantidad]" class="input input-bordered w-full" min="1" value="{{ $detalle->cantidad }}" required>

                    <button type="button" onclick="eliminarProducto(this)" class="btn btn-error btn-sm mt-4 w-full md:w-auto">
                        Eliminar producto
                    </button>
                </div>
            @endforeach
        </div>

        <button type="button" onclick="agregarProducto()" class="btn btn-outline btn-accent w-full md:w-auto">
            + Agregar producto
        </button>

        {{-- Valor pagado --}}
        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1">Valor pagado</label>
            <input type="number" name="valor_pagado" class="input input-bordered w-full" min="0" value="{{ $venta->valor_pagado }}" required>
        </div>

        {{-- Botones --}}
        <div class="flex justify-between gap-4 pt-6">
            <a href="{{ route('ventas.index') }}" class="btn btn-secondary w-full md:w-auto">Cancelar</a>
            <button type="submit" class="btn btn-primary w-full md:w-auto">Guardar Cambios</button>
        </div>
    </form>
</div>

<script>
    let index = {{ count($venta->detalleVentas) }};

    function agregarProducto() {
        const container = document.getElementById('productos-container');
        const row = document.createElement('div');
        row.classList.add('producto-row', 'border', 'p-4', 'rounded-lg', 'bg-base-200');
        row.innerHTML = `
            <label class="block font-semibold mb-1 text-gray-700">Producto</label>
            <select name="productos[${index}][producto_id]" class="select select-bordered w-full" required>
                <option value="">Seleccione producto</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">
                        {{ $producto->nombre }} - ${{ number_format($producto->precio) }}
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
        if (row) row.remove();
    }
</script>

@endsection
