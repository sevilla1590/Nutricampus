@extends('layouts.admin')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-4">Editar Reembolso</h1>

        <form action="{{ route('reembolsos.update', $reembolso->id_reembolso) }}" method="POST">
            @csrf
            @method('PUT') <!-- Indica que es una actualización -->

            <!-- Campo para el estado del reembolso -->
            <div class="mb-4">
                <label for="estado" class="block text-gray-700">Estado</label>
                <select name="estado" id="estado" class="w-full border-gray-300 rounded">
                    <option value="enviado" {{ $reembolso->estado == 'enviado' ? 'selected' : '' }}>Enviado</option>
                    <option value="aprobado" {{ $reembolso->estado == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                    <option value="rechazado" {{ $reembolso->estado == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                </select>
            </div>

            <!-- Campo para la respuesta -->
            <div class="mb-4">
                <label for="respuesta" class="block text-gray-700">Respuesta</label>
                <textarea name="respuesta" id="respuesta" rows="4" class="w-full border-gray-300 rounded">{{ old('respuesta', $reembolso->respuesta) }}</textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Guardar Cambios
            </button>
        </form>

        <a href="{{ route('reembolsos.index') }}" class="text-blue-500 hover:underline">Ver Reembolsos</a>

    </div>
@endsection
