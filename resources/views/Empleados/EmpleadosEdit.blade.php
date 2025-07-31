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
    <div class="max-w-2xl mx-auto mt-10 bg-base-100 p-6 rounded shadow">
        <h2 class="text-2xl text-center font-bold mb-8 text-primary">EDITAR EMPLEADO</h2>
        <form action="{{ route('empleados.update', $empleado) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            @method('PUT')

            <div>
                <label class=" text-sm font-semibold text-gray-600">Nombre</label>
                <input type="text" name="nombre" value="{{ $empleado->nombre }}" class="input input-bordered w-full">
            </div>

            <div>
                <label class=" text-sm font-semibold text-gray-600">Cedula</label>
                <input type="number" name="cedula" value="{{ $empleado->cedula }}" class="input input-bordered w-full">
            </div>

            <div>
                <label class=" text-sm font-semibold text-gray-600">Edad</label>
                <input type="number" name="edad" value="{{ $empleado->edad }}" class="input input-bordered w-full">
            </div>

            <div>
                <label class=" text-sm font-semibold text-gray-600">Celular</label>
                <input type="number" name="celular" value="{{ $empleado->celular }}" class="input input-bordered w-full">
            </div>

            <div class="md:col-span-2">
                <label class=" text-sm font-semibold text-gray-600">Rol</label>
                <select name="rol_id" class="select select-bordered w-full">
                    <option value="">Seleccione un rol</option>
                    @foreach ($rol as $rol)
                        <option value="{{ $rol->id }}"{{ $rol->id == $empleado->rol_id ? 'selected' : '' }}>
                            {{ $rol->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2 flex justify-center gap-4 pt-4">
                <a href="{{ route('empleados.index') }}" class="btn btn-warning">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>

    </div>


@endsection
