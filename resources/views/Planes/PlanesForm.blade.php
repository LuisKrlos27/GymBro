@extends('Home.HomeIndex')
@section('content')

    <div class="max-w-2xl mx-auto mt-10 bg-base-100 p-6 rounded shadow">
        <h2 class="text-2xl text-center font-bold mb-6">REGISTRO DE PLAN</h2>
        <form action="{{ route('planes.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            <div>
                <label class="label">Nombre</label>
                <input type="text" name="nombre" class="input input-bordered w-full" required>
            </div>

            <div>
                <label class="label">Días</label>
                <input type="number" name="duracion_dias" class="input input-bordered w-full" required>
            </div>

            <div>
                <label class="label">Precio</label>
                <input type="number" step="0.01" name="precio" class="input input-bordered w-full" required>
            </div>

            <div class="md:col-span-2 flex justify-center gap-4 pt-4">
                <a href="{{ route('planes.index') }}" class="btn btn-warning">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>


    </div>


@endsection
