@extends('Home.HomeIndex')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6 text-center text-primary">VENTAS</h2>

    @if(session('success'))
        <div class="alert alert-success mb-4 shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if($venta->isEmpty())
        <p class="text-center text-gray-600">No hay ventas registradas.</p>
    @else
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                        <th>Precio</th>
                        <th>Total</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venta as $ven)
                        <tr>
                            <td>{{ $ven->id }}</td>
                            <td>{{ $ven->cliente->nombre }}</td>
                            <td> @foreach($ven->detalles_json as $detalle)
                                    {{ $detalle['nombre']}}
                                @endforeach
                            </td>
                            <td> @foreach($ven->detalles_json as $detalle)
                                    {{ $detalle['cantidad']}}
                                @endforeach
                            </td>
                            <td>{{ \Carbon\Carbon::parse($ven->fecha)->format('d/m/Y') }}</td>
                            <td> @foreach($ven->detalles_json as $detalle)
                                    ${{ number_format($detalle['precio_unitario'])}}
                                @endforeach
                            </td>

                            <td>${{ number_format($ven->total) }}</td>
                            <td class="flex flex-col sm:flex-row gap-1">
                                <a href="{{ route('ventas.show', $ven->id) }}" class="btn btn-sm btn-info">Ver factura</a>
                                <a href="{{ route('ventas.edit', $ven->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('ventas.destroy', $ven->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este pago?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-error" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<script>
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
