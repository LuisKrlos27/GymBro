@extends('Home.HomeIndex')
@section('content')
    <div class="max-w-2xl mx-auto mt-10 bg-base-100 p-6 rounded shadow">
        <h2 class="text-2xl text-center font-bold mb-6">EDITAR CLIENTE</h2>
        <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            @method('PUT')

            <div>
                <label class="label">Nombre</label>
                <input type="text" name="nombre" value="{{ $cliente->nombre }}" class="input input-bordered w-full">
            </div>

            <div>
                <label class="label">Cedula</label>
                <input type="number" name="cedula" value="{{ $cliente->cedula }}" class="input input-bordered w-full">
            </div>

            <div>
                <label class="label">Celular</label>
                <input type="number" name="celular" value="{{ $cliente->celular }}" class="input input-bordered w-full">
            </div>


            <div>
                <label class="label">Edad</label>
                <input type="number" name="edad" value="{{ $cliente->edad }}" class="input input-bordered w-full">
            </div>

            <div class="md:col-span-2 flex justify-center gap-4 pt-4">
                <a href="{{ route('clientes.index') }}" class="btn btn-warning">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>

    </div>


@endsection
