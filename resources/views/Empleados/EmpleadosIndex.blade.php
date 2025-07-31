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
        <h2 class="text-xl font-bold text-center text-accent">EMPLEADOS</h2>
    </div>

    <div class="flex justify-end mb-4">
        <a href="{{ route('empleados.create') }}" class="font-bold btn btn-success">REGISTRAR</a>
    </div>

    <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th class=" text-sm font-semibold text-gray-600">#</th>
                <th class=" text-sm font-semibold text-gray-600">Nombre</th>
                <th class=" text-sm font-semibold text-gray-600">Cedula</th>
                <th class=" text-sm font-semibold text-gray-600">Edad</th>
                <th class=" text-sm font-semibold text-gray-600">Celular</th>
                <th class=" text-sm font-semibold text-gray-600">Rol</th>
                <th class=" text-sm font-semibold text-gray-600">Opciones</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($empleado as $emp)
                    <tr>
                        <td>{{ $emp->id }}</td>
                        <td>{{ $emp->nombre }}</td>
                        <td>{{ $emp->cedula }}</td>
                        <td>{{ $emp->edad }}</td>
                        <td>{{ $emp->celular }}</td>
                        <td>{{ $emp->rol->nombre }}</td>
                        <td class="flex flex-col sm:flex-row gap-1">
                            <a href="{{ route('empleados.edit', $emp->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('empleados.destroy', $emp->id) }}" method="POST" onsubmit="return confirm('¿Estas seguro de eliminar este empleado?')">
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
