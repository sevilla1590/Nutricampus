@extends('layouts.layout')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-4">Lista de Pedidos</h1>

        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">ID</th>
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
                        <td class="border border-gray-300 px-4 py-2">{{ $pedido->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $pedido->id_cliente }}</td>
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
        <a href="{{ route('admin.dashboard') }}" class="text-blue-500 hover:underline mt-4 block">
            Volver al Panel de Administración
        </a>
    </div>
@endsection
