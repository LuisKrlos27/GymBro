@extends('Home.HomeIndex')
@section('content')

    <div class="max-w-2xl mx-auto mt-10 bg-base-100 p-6 rounded shadow">
        <h2 class="text-2xl text-center font-bold mb-6 text-primary">REGISTRO DE CITA</h2>
        <form action="{{ route('citas.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            <div class="md:col-span-2">
                <label class=" text-sm font-semibold text-gray-600">Cliente</label>
                <select name="cliente_id" class="select select-bordered w-full">
                    <option value="">Seleccione un ciente</option>
                    @foreach ($cliente as $cli)
                        <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <label class=" text-sm font-semibold text-gray-600">Empleado</label>
                <select name="empleado_id" class="select select-bordered w-full">
                    <option value="">Seleccione un nutricionista</option>
                    @foreach ($empleado as $emp)
                        <option value="{{ $emp->id }}">{{ $emp->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class=" text-sm font-semibold text-gray-600">Fecha</label>
                <input type="date" name="fecha" class="input input-bordered w-full">
            </div>

            <div>
                <label class=" text-sm font-semibold text-gray-600">Descripción</label>
                <input type="text" name="descripcion" class="input input-bordered w-full">
            </div>

            <div class="md:col-span-2 flex justify-center gap-4 pt-4">
                <a href="{{ route('citas.index') }}" class="btn btn-warning">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>

    </div>


@endsection
