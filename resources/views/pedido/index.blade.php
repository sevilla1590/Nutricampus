@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Encabezado -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Lista de Pedidos</h1>
                    <p class="mt-1 text-sm text-gray-500">Gestiona y monitorea todos los pedidos</p>
                </div>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Volver al Panel
                </a>
            </div>

            <!-- Card principal -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Filtros -->
                <div class="p-6 border-b border-gray-200 bg-gray-50">
                    <form method="GET" action="{{ route('pedidos.listar') }}" class="flex items-center space-x-4">
                        <div class="flex-1 max-w-xs">
                            <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">
                                Filtrar por estado
                            </label>
                            <select name="estado" id="estado"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Todos los estados</option>
                                @foreach (['en cola', 'en preparación', 'en camino', 'entregado'] as $estado)
                                    <option value="{{ $estado }}"
                                        {{ request('estado') == $estado ? 'selected' : '' }}>
                                        {{ ucfirst($estado) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                            class="mt-7 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                            Aplicar filtro
                        </button>
                    </form>
                </div>

                <!-- Tabla de pedidos -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cliente
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($pedidos as $pedido)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $pedido->cliente->nombre ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $pedido->fecha }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">S/ {{ number_format($pedido->total, 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full   
                                    {{ $pedido->estado == 'entregado' ? 'bg-green-100 text-green-800' : '' }}  
                                    {{ $pedido->estado == 'en cola' ? 'bg-yellow-100 text-yellow-800' : '' }}  
                                    {{ $pedido->estado == 'en preparación' ? 'bg-blue-100 text-blue-800' : '' }}  
                                    {{ $pedido->estado == 'en camino' ? 'bg-purple-100 text-purple-800' : '' }}">
                                            {{ ucfirst($pedido->estado) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                        <a href="{{ route('pedido.show', $pedido->id) }}"
                                            class="text-blue-600 hover:text-blue-900 transition-colors">
                                            Ver detalle
                                        </a>
                                        <a href="{{ route('pedido.edit', $pedido->id) }}"
                                            class="text-green-600 hover:text-green-900 transition-colors">
                                            Cambiar estado
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            /* Estilos adicionales si son necesarios */
            .table-hover tr:hover {
                background-color: rgba(249, 250, 251, 1);
            }
        </style>
    @endpush
@endsection
