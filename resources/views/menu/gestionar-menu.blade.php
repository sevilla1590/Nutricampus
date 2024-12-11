@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gray-200 py-8 w-full">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Encabezado -->
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-4xl font-bold text-gray-800">Gestionar Menú</h1>
                <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-800 transition-colors">
                    Volver al Panel
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Columna izquierda -->
                <div class="space-y-6">
                    <!-- Formulario Crear Producto -->
                    <div
                        class="bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                        <div class="p-4 border-b border-gray-100">
                            <h2 class="text-xl font-semibold text-gray-800">Crear Producto</h2>
                        </div>

                        <form id="producto-form" action="{{ route('productos.crearProducto') }}" method="POST"
                            class="p-4 space-y-4">
                            @csrf
                            <input type="hidden" name="id" id="producto-id">

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-700">Nombre</label>
                                    <input type="text" name="nombre" id="nombre"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg shadow-sm hover:shadow transition-shadow duration-200"
                                        required>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-700">Precio (S/)</label>
                                    <input type="number" name="precio" id="precio" step="0.01"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg shadow-sm hover:shadow transition-shadow duration-200"
                                        required>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-700">Descripción</label>
                                    <textarea name="descripcion" id="descripcion" rows="2"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg shadow-sm hover:shadow transition-shadow duration-200"></textarea>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-700">Beneficios</label>
                                    <textarea name="beneficios" id="beneficios" rows="2"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg shadow-sm hover:shadow transition-shadow duration-200"></textarea>
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-700">Disponibilidad</label>
                                <input type="number" name="disponibilidad" id="disponibilidad"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg shadow-sm hover:shadow transition-shadow duration-200"
                                    required>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 shadow-md hover:shadow-lg transition-all duration-200">
                                    Crear Producto
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Resumen de Carta -->
                    <div
                        class="bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                        <div class="p-4 border-b border-gray-100">
                            <h2 class="text-xl font-semibold text-gray-800">Resumen de Carta</h2>
                            <p class="text-sm text-gray-500">Productos actualmente en la carta</p>
                        </div>
                        <div class="p-4">
                            <div class="space-y-2">
                                @foreach ($menu as $producto)
                                    <div
                                        class="flex justify-between items-center p-2 bg-gray-50 rounded-lg shadow-sm hover:shadow transition-all duration-200">
                                        <span class="text-gray-800">{{ $producto->nombre }}</span>
                                        <span class="text-gray-600">S/ {{ number_format($producto->precio, 2) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna derecha: Selección de productos -->
                <div
                    class="bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-4 border-b border-gray-100">
                        <h2 class="text-xl font-semibold text-gray-800">Productos en Carta</h2>
                        <p class="text-sm text-gray-500">Selecciona los productos disponibles</p>
                    </div>

                    <form action="{{ route('productos.actualizarCarta') }}" method="POST" class="p-4">
                        @csrf
                        <div class="space-y-2">
                            @foreach ($productos as $producto)
                                <label
                                    class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer shadow-sm hover:shadow transition-all duration-200">
                                    <input type="checkbox" name="productos[]" value="{{ $producto->id }}"
                                        {{ $menu->contains($producto) ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 rounded">
                                    <div class="ml-3 flex justify-between w-full">
                                        <span class="text-gray-800">{{ $producto->nombre }}</span>
                                        <span class="text-gray-600">S/ {{ number_format($producto->precio, 2) }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            <button type="submit"
                                class="w-full px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 shadow-md hover:shadow-lg transition-all duration-200">
                                Actualizar Carta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
