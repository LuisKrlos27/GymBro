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
    <h2 class="text-3xl font-bold text-center text-primary mb-8">LISTADO DE CITAS</h2>
        <div class="flex justify-end mb-4">
            <a href="{{ route('citas.create') }}" class="font-bold btn btn-outline btn-success">REGISTRAR</a>
        </div>

    @if($cita->isEmpty())
        <p class="text-center text-gray-600">No hay citas registradas.</p>
        @else

        <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
            <table class="table">
                <thead>
                <tr>
                    <th class=" text-sm font-semibold text-gray-600">#</th>
                    <th class=" text-sm font-semibold text-gray-600">Cliente</th>
                    <th class=" text-sm font-semibold text-gray-600">Nutricionista</th>
                    <th class=" text-sm font-semibold text-gray-600">Fecha</th>
                    <th class=" text-sm font-semibold text-gray-600">Descripcion</th>
                    <th class=" text-sm font-semibold text-gray-600">Opciones</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($cita as $cit)
                        <tr>
                            <td>{{ $cit->id }}</td>
                            <td>{{ $cit->cliente->nombre }}</td>
                            <td>{{ $cit->empleado->nombre }}</td>
                            <td>{{ $cit->fecha }}</td>
                            <td>{{ $cit->descripcion }}</td>
                            <td class="flex flex-col sm:flex-row gap-1">
                                <a href="{{ route('citas.edit', $cit->id) }}" class="font-bold btn-sm btn btn-outline btn-warning">Editar</a>
                                <form action="{{ route('citas.destroy', $cit->id) }}" method="POST" onsubmit="return confirm('¿Estas seguro de eliminar este cliente.?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="font-bold btn-sm btn btn-outline btn-error" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
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
