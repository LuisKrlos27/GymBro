@extends('Home.HomeIndex')
@section('content')

    <div class="max-w-2xl mx-auto mt-10 bg-base-100 p-6 rounded shadow">
        <h2 class="text-2xl text-center font-bold mb-6">REGISTRO DE CLIENTE</h2>
        <form action="{{ route('clientes.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            <div>
                <label class="label">Nombre</label>
                <input type="text" name="nombre" class="input input-bordered w-full">
            </div>

            <div>
                <label class="label">Cédula</label>
                <input type="number" name="cedula" class="input input-bordered w-full">
            </div>

            <div>
                <label class="label">Edad</label>
                <input type="number" name="edad" class="input input-bordered w-full">
            </div>

            <div>
                <label class="label">Celular</label>
                <input type="number" name="celular" class="input input-bordered w-full">
            </div>

            <div class="md:col-span-2 flex justify-center gap-4 pt-4">
                <a href="{{ route('clientes.index') }}" class="btn btn-warning">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>

    </div>


@endsection
