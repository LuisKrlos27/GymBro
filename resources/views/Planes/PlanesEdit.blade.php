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
        <h2 class="text-2xl text-center font-bold mb-6 text-primary">EDITAR PLAN</h2>
        <form action="{{ route('planes.update', $plan->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            @method('PUT')

            <div>
                <label class=" text-sm font-semibold text-gray-600">Nombre</label>
                <input type="text" name="nombre" value="{{ $plan->nombre }}" class="input input-bordered w-full" >
            </div>

            <div>
                <label class=" text-sm font-semibold text-gray-600">Dias</label>
                <input type="number" name="duracion_dias" value="{{ $plan->duracion_dias }}" class="input input-bordered w-full" >
            </div>

            <div>
                <label class=" text-sm font-semibold text-gray-600">Precio</label>
                <input type="number" name="precio" value="{{ $plan->precio }}" class="input input-bordered w-full" >
            </div>

            <div class="md:col-span-2 flex justify-center gap-4 pt-4">
                <a href="{{ route('planes.index') }}" class="btn btn-warning">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>

    </div>


@endsection
