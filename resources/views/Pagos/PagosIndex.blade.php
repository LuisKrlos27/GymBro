@extends('Home.HomeIndex')
@section('content')

@if (session('success'))
    <div id="success-alert" class="alert alert-success shadow-lg mb-4 transition-opacity duration-500">
        <span>{{ session('success') }}</span>
    </div>
@endif

@if (session('error'))
    <div id="error-alert" class="alert alert-error shadow-lg mb-4 transition-opacity duration-500">
        <span>{{ session('error') }}</span>
    </div>
@endif

<div class="max-w-6xl mx-auto mt-10 bg-base-100 p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold text-center text-primary mb-8">LISTADO DE PAGOS</h2>
        <div class="flex justify-end mb-4">
            <a href="{{ route('pagos.create') }}" class="font-bold btn btn-success">REGISTRAR</a>
        </div>

    @if($pago->isEmpty())
        <p class="text-center text-gray-600">No hay pagos registrados.</p>
        @else

        <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Plan</th>
                        <th>Fecha Pago</th>
                        <th>Vencimiento</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pago as $pag)
                        <tr>
                            <td>{{ $pag->id }}</td>
                            <td>{{ $pag->cliente->nombre }}</td>
                            <td>{{ $pag->plan->nombre }}</td>
                            <td>{{ $pag->fecha_pago }}</td>
                            <td>{{ $pag->fecha_vencimiento }}</td>
                            <td>
                                @if ($pag->estado)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-error">Inactivo</span>
                                @endif
                            </td>
                            <td class="flex flex-col sm:flex-row gap-1">
                                <a href="{{ route('pagos.show', $pag->id) }}" class="btn btn-sm btn-info">Ver factura</a>
                                <a href="{{ route('pagos.edit', $pag->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('pagos.destroy', $pag->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este pago?')">
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
