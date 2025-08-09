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
        <h2 class="text-2xl text-center font-bold mb-6 text-primary">EDITAR ASISTENCIAS</h2>
        <form action="{{ route('asistencias.update', $asistencia) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Cliente</label>
                <select name="cliente_id" class="select select-bordered w-full" required>
                    @foreach($cliente as $cliente)
                        <option value="{{ $cliente->id }}" {{ $cliente->id == $asistencia->cliente_id ? 'selected' : '' }}>
                            {{ $cliente->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="label">Fecha</label>
                <input type="date" name="fecha_asistencia"
                    value="{{ \Carbon\Carbon::parse($asistencia->fecha_asistencia)->format('Y-m-d') }}"
                    class="input input-bordered w-full" required>
            </div>

            <div class="md:col-span-2 flex justify-center gap-4 pt-4">
                <a href="{{ route('asistencias.index') }}" class="btn btn-warning">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>

    </div>


@endsection
