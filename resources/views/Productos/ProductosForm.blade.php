@extends('Home.HomeIndex')
@section('content')

    <div class="max-w-2xl mx-auto mt-10 bg-base-100 p-6 rounded shadow">
        <h2 class="text-2xl text-center font-bold mb-8 text-primary">REGISTRO DE PRODUCTOS</h2>
        <form action="{{ route('productos.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            <div>
                <label class=" text-sm font-semibold text-gray-600">Nombre</label>
                <input type="text" name="nombre" class="input input-bordered w-full">
            </div>

            <div>
                <label class=" text-sm font-semibold text-gray-600">Precio</label>
                <input type="number" name="precio" class="input input-bordered w-full">
            </div>

            <div>
                <label class=" text-sm font-semibold text-gray-600">Cantidad</label>
                <input type="number" name="cantidad" class="input input-bordered w-full">
            </div>

            <div class="md:col-span-2 flex justify-center gap-4 pt-4">
                <a href="{{ route('productos.index') }}" class="btn btn-warning">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>

    </div>


@endsection
