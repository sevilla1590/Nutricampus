@extends('layouts.layout')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-4">Cambiar Estado del Pedido</h1>

        <form action="{{ route('pedido.update', $pedido->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="estado" class="block text-gray-700 font-semibold mb-2">Estado</label>
        <select name="estado" id="estado" class="w-full border-gray-300 rounded">
            <option value="en cola" {{ $pedido->estado == 'en cola' ? 'selected' : '' }}>En cola</option>
            <option value="en preparación" {{ $pedido->estado == 'en preparación' ? 'selected' : '' }}>En preparación</option>
            <option value="en camino" {{ $pedido->estado == 'en camino' ? 'selected' : '' }}>En camino</option>
            <option value="entregado" {{ $pedido->estado == 'entregado' ? 'selected' : '' }}>Entregado</option>
        </select>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Guardar Cambios
    </button>
</form>

<a href="{{ route('pedidos.listar') }}" class="text-blue-500 hover:underline mt-4 block">
    Cancelar
</a>

    </div>
@endsection
