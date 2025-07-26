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
        <h2 class="text-xl font-bold text-center">CITAS</h2>
    </div>

    <div class="flex justify-end mb-4">
        <a href="{{ route('citas.create') }}" class="btn btn-success">REGISTRAR</a>
    </div>

    <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Nutricionista</th>
                <th>Fecha</th>
                <th>Descripcion</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($cita as $cit)
                    <tr>
                        <th>{{ $cit->id }}</th>
                        <td>{{ $cit->cliente->nombre }}</td>
                        <td>{{ $cit->empleado->nombre }}</td>
                        <td>{{ $cit->fecha }}</td>
                        <td>{{ $cit->descripcion }}</td>
                        <td class="flex flex-col sm:flex-row gap-1">
                            <a href="{{ route('citas.edit', $cit->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('citas.destroy', $cit->id) }}" method="POST" onsubmit="return confirm('¿Estas seguro de eliminar este cliente.?')">
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
                setTimeout(() => success.remove(), 500); // Quita el elemento del DOM tras desvanecer
            }

            if (error) {
                error.style.opacity = '0';
                setTimeout(() => error.remove(), 500);
            }
        }, 3000); // 3 segundos
    </script>

@endsection
