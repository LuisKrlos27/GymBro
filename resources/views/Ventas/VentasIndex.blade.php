@extends('Home.HomeIndex')

@section('content')
<!-- Mensajes de éxito y error con desvanecimiento -->
    @if (session('success'))
        <div id="success-alert" class="alert alert-success shadow-lg mb-4 md:col-span-4 transition-opacity duration-500">
            <div>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div id="error-alert" class="alert alert-error shadow-lg mb-4 md:col-span-4 transition-opacity duration-500">
            <div>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif
<div class="max-w-6xl mx-auto mt-10 bg-base-100 p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold text-center text-primary mb-8">LISTADO DE VENTAS</h2>
    @if($venta->isEmpty())
        <p class="text-center text-gray-600">No hay ventas registradas.</p>
    @else
        <div class="overflow-x-auto">
            <table class="table table-zebra w-full text-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Productos</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venta as $ven)
                        <tr>
                            <td>{{ $ven->id }}</td>
                            <td>{{ $ven->cliente->nombre }}</td>
                            <td>
                                <ul>
                                    @foreach($ven->detalleVentas as $detalle)
                                        <li>{{ $detalle->producto->nombre }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    @foreach($ven->detalleVentas as $detalle)
                                        <li>{{ $detalle->cantidad }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    @foreach($ven->detalleVentas as $detalle)
                                        <li>${{ number_format($detalle->precio_unitario) }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>${{ number_format($ven->total) }}</td>
                            <td>{{ \Carbon\Carbon::parse($ven->fecha)->format('d/m/Y') }}</td>
                            <td class="flex flex-col sm:flex-row gap-2">
                                <a href="{{ route('ventas.show', $ven->id) }}" class="btn btn-sm btn-info">Ver factura</a>
                                <a href="{{ route('ventas.edit', $ven->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('ventas.destroy', $ven->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta venta?')">
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
