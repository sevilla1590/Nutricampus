@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gray-200 py-6 sm:py-12">
        <div class="container mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <!-- Encabezado -->
            <br>
            <div class="mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 leading-tight">
                    Editar Platillo
                </h1>
                <p class="mt-2 text-sm text-gray-600">
                    Actualiza la información del platillo en el menú
                </p>
            </div>

            <!-- Formulario -->
            <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-4 sm:p-6 md:p-8">
                    <form action="{{ route('productos.actualizarPlatillo', $producto->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4 sm:space-y-6">
                            <!-- Nombre -->
                            <div>
                                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nombre del Platillo
                                </label>
                                <input type="text" name="nombre" id="nombre"
                                    value="{{ old('nombre', $producto->nombre) }}"
                                    class="mt-1 block w-full px-3 sm:px-4 py-2 sm:py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                    required>
                            </div>

                            <!-- Descripción -->
                            <div>
                                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">
                                    Descripción
                                </label>
                                <textarea name="descripcion" id="descripcion" rows="4"
                                    class="mt-1 block w-full px-3 sm:px-4 py-2 sm:py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">{{ old('descripcion', $producto->descripcion) }}</textarea>
                            </div>

                            <!-- Precio y Disponibilidad -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <div>
                                    <label for="precio" class="block text-sm font-medium text-gray-700 mb-1">
                                        Precio (S/)
                                    </label>
                                    <div class="mt-1 relative rounded-lg">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm mr-1">S/</span>
                                        </div>
                                        <input type="number" name="precio" id="precio"
                                            value="{{ old('precio', $producto->precio) }}"
                                            class="block w-full pl-12 pr-3 py-2 sm:py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                            required step="0.01" min="0">
                                    </div>
                                </div>

                                <div>
                                    <label for="disponibilidad" class="block text-sm font-medium text-gray-700 mb-1">
                                        Disponibilidad
                                    </label>
                                    <input type="number" name="disponibilidad" id="disponibilidad"
                                        value="{{ old('disponibilidad', $producto->disponibilidad) }}"
                                        class="mt-1 block w-full px-3 sm:px-4 py-2 sm:py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                        required>
                                </div>
                            </div>

                            <!-- Botones de acción -->
                            <div
                                class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-4">
                                <a href="{{ route('productos.gestionarPlatillos') }}"
                                    class="px-4 sm:px-6 py-2 sm:py-3 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-all duration-200 text-center">
                                    Cancelar
                                </a>
                                <button type="submit"
                                    class="px-4 sm:px-6 py-2 sm:py-3 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg">
                                    Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
