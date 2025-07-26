@extends('Home.HomeIndex')
@section('content')

    <div class="max-w-2xl mx-auto mt-10 bg-base-100 p-6 rounded shadow">
        <h2 class="text-2xl text-center font-bold mb-6">REGISTRO DE PAGO</h2>
        <form action="{{ route('pagos.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            <div class="md:col-span-2">
                <label class="label">Cliente</label>
                <select name="cliente_id" class="select select-bordered w-full">
                    <option value="">Seleccione un ciente</option>
                    @foreach ($cliente as $cli)
                        <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="label">Plan</label>
                <select name="plan_id" class="select select-bordered w-full">
                    <option value="">Seleccione un plan</option>
                    @foreach ($plan as $pla)
                        <option value="{{ $pla->id }}">{{ $pla->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="label">Fecha</label>
                <input type="date" name="fecha_pago" class="input input-bordered w-full">
            </div>

            <div>
                <label class="label">Estado</label>
                <select name="estado" class="select select-bordered w-full">
                    <option value="0" selected>Inactivo</option>
                    <option value="1">Activo</option>
                </select>
            </div>


            <div class="md:col-span-2 flex justify-center gap-4 pt-4">
                <a href="{{ route('pagos.index') }}" class="btn btn-warning">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>

    </div>


@endsection
