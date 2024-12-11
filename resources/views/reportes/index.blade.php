@extends('layouts.admin')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Reportes de Gestión</h1>

        <!-- Ventas Totales -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="font-semibold text-xl text-gray-700 mb-4">Ventas Totales</h2>
            <p class="text-gray-600 text-lg">S/ {{ number_format($ventasTotales, 2) }}</p>
        </div>

        <!-- Cliente que más compró -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="font-semibold text-xl text-gray-700 mb-4">Cliente que más compró</h2>
            @if ($clienteMasCompradorInfo)
                <p class="text-gray-600 text-lg">
                    {{ $clienteMasCompradorInfo['nombre'] }} - Total: S/
                    {{ number_format($clienteMasCompradorInfo['total_compras'], 2) }}
                </p>
            @else
                <p class="text-gray-600 text-lg">No hay datos disponibles.</p>
            @endif
        </div>

        <!-- Número total de clientes activos -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="font-semibold text-xl text-gray-700 mb-4">Número Total de Clientes Activos</h2>
            <p class="text-gray-600 text-lg">{{ $clientesActivos }}</p>
        </div>

        <!-- Ranking de productos más comprados -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="font-semibold text-xl text-gray-700 mb-4">Ranking de Productos Más Comprados</h2>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-b text-left text-gray-600">Producto</th>
                        <th class="px-4 py-2 border-b text-left text-gray-600">Cantidad Vendida</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productosMasComprados as $producto)
                        <tr>
                            <td class="px-4 py-2 border-b">{{ $producto['nombre'] }}</td>
                            <td class="px-4 py-2 border-b">{{ $producto['cantidad'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
