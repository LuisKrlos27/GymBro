@extends('Home.HomeIndex')

@section('content')
<div class="max-w-xl mx-auto bg-base-100 p-6 mt-10 rounded shadow">
    <h2 class="text-2xl font-bold text-center mb-6 text-primary">ASISTENCIAS</h2>

    <form action="{{ route('asistencias.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class=" text-sm font-semibold text-gray-600">Cliente</label>
            <select name="cliente_id" class="select select-bordered w-full" required>
                <option value="">Seleccione un cliente</option>
                @foreach ($cliente as $cli)
                    <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-center gap-4 pt-4">
            <a href="{{ route('asistencias.index') }}" class="btn btn-warning">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>
@endsection
