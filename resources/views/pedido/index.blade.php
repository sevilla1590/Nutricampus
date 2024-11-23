@extends('layouts.layout')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-4">Lista de Pedidos</h1>

        <!-- Filtro por estado -->
        <form method="GET" action="{{ route('pedidos.listar') }}" class="mb-4">
            <label for="estado" class="mr-2">Filtrar por estado:</label>
            <select name="estado" id="estado" class="border border-gray-300 rounded px-4 py-2">
                <option value="">Todos</option>
                <option value="en cola" {{ request('estado') == 'en cola' ? 'selected' : '' }}>En cola</option>
                <option value="en preparación" {{ request('estado') == 'en preparación' ? 'selected' : '' }}>En preparación</option>
                <option value="en camino" {{ request('estado') == 'en camino' ? 'selected' : '' }}>En camino</option>
                <option value="entregado" {{ request('estado') == 'entregado' ? 'selected' : '' }}>Entregado</option>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filtrar</button>
        </form>


        <!-- Tabla de pedidos -->
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Cliente</th>
                    <th class="border border-gray-300 px-4 py-2">Fecha</th>
                    <th class="border border-gray-300 px-4 py-2">Total</th>
                    <th class="border border-gray-300 px-4 py-2">Estado</th>
                    <th class="border border-gray-300 px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $pedido->cliente->nombre ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $pedido->fecha }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $pedido->total }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $pedido->estado }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('pedido.show', $pedido->id) }}" class="text-blue-500 hover:underline">Ver detalle</a>
                            <a href="{{ route('pedido.edit', $pedido->id) }}" class="text-green-500 hover:underline">Cambiar estado</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Enlace para volver al panel de administración -->
        <a href="{{ route('admin.dashboard') }}" class="text-blue-500 hover:underline mt-4 block">
            Volver al Panel de Administración
        </a>
    </div>
@endsection
