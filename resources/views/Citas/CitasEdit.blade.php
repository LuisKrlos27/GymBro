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
        <h2 class="text-2xl text-center font-bold mb-6">EDITAR CITA</h2>
        <form action="{{ route('citas.update', $cita) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            @method('PUT')

            <div class="md:col-span-2">
                <label class="label">Cliente</label>
                <select name="cliente_id" class="select select-bordered w-full">
                    <option value="">Seleccione un cliente</option>
                    @foreach ($cliente as $cli)
                        <option value="{{ $cli->id }}"{{ $cli->id == $cita->cliente_id ? 'selected' : '' }}>
                            {{ $cli->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="label">Empleado</label>
                <select name="empleado_id" class="select select-bordered w-full">
                    <option value="">Seleccione un empleado</option>
                    @foreach ($empleado as $emp)
                        <option value="{{ $emp->id }}"{{ $emp->id == $cita->empleado_id ? 'selected' : '' }}>
                            {{ $emp->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="label">Fecha</label>
                <input type="date" name="fecha" value="{{ \Carbon\Carbon::parse($cita->fecha)->format('Y-m-d') }}" class="input input-bordered w-full">
            </div>

            <div>
                <label class="label">Descripcion</label>
                <input type="text" name="descripcion" value="{{ $cita->descripcion }}" class="input input-bordered w-full">
            </div>

            <div class="md:col-span-2 flex justify-center gap-4 pt-4">
                <a href="{{ route('citas.index') }}" class="btn btn-warning">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>

    </div>


@endsection
