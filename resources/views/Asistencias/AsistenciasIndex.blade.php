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

<div class="relative mb-4">
    <h2 class="text-xl font-bold text-center text-accent">ASISTENCIAS</h2>
</div>

<!-- FILTRO -->
<form method="GET" action="{{ route('asistencias.index') }}" class="flex flex-col md:flex-row gap-2 justify-center mb-4">
    <input type="text" name="cliente" placeholder="Buscar por cliente" value="{{ request('cliente') }}"
        class="input input-bordered w-full md:w-1/9" />

    <button type="submit" class="font-bold btn btn-outline btn-primary">Filtrar</button>
    <a href="{{ route('asistencias.index') }}" class="font-bold btn btn-outline">Limpiar</a>

    <div class="flex justify-end mb-4">
        <a href="{{ route('asistencias.create') }}" class="font-bold btn btn-outline btn-success">REGISTRAR</a>
    </div>
</form>



<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
    <table class="table">
        <thead>
            <tr>
                <th class="text-sm font-semibold text-gray-600">#</th>
                <th class="text-sm font-semibold text-gray-600">Cliente</th>
                <th class="text-sm font-semibold text-gray-600">Fecha y hora</th>
                <th class="text-sm font-semibold text-gray-600">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asistencia as $asi)
                <tr>
                    <td>{{ $asi->id }}</td>
                    <td>{{ $asi->cliente->nombre }}</td>
                    <td>{{ \Carbon\Carbon::parse($asi->fecha_asistencia)->format('d/m/Y H:i') }}</td>
                    <td class="flex flex-col sm:flex-row gap-1">
                        <form action="{{ route('asistencias.destroy', $asi->id) }}" method="POST" onsubmit="return confirm('¿Estas seguro de eliminar esta asistencia?')">
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

<!-- Script para ocultar alertas después de 3 segundos -->
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
