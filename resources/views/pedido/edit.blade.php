@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gray-200 py-8 w-full">
        <div class="container mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
            <!-- Encabezado con mejor espaciado -->
            <br>
            <br>
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 leading-tight">
                    Cambiar Estado del Pedido
                </h1>
                <p class="mt-2 text-sm text-gray-600">
                    Actualiza el estado actual del pedido
                </p>
            </div>

            <!-- Card principal con sombra mejorada -->
            <div
                class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('pedido.update', $pedido->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <!-- Select con diseño mejorado -->
                            <div>
                                <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">
                                    Estado del Pedido
                                </label>
                                <div class="relative">
                                    <select name="estado" id="estado"
                                        class="block w-full px-4 py-3 bg-white border border-gray-300 rounded-lg shadow-sm   
                                        focus:ring-2 focus:ring-blue-200 focus:border-blue-500   
                                        transition-all duration-200 appearance-none  
                                        text-gray-900 text-sm">
                                        <option value="en cola" {{ $pedido->estado == 'en cola' ? 'selected' : '' }}
                                            class="py-2">
                                            En cola
                                        </option>
                                        <option value="en preparación"
                                            {{ $pedido->estado == 'en preparación' ? 'selected' : '' }} class="py-2">
                                            En preparación
                                        </option>
                                        <option value="en camino" {{ $pedido->estado == 'en camino' ? 'selected' : '' }}
                                            class="py-2">
                                            En camino
                                        </option>
                                        <option value="entregado" {{ $pedido->estado == 'entregado' ? 'selected' : '' }}
                                            class="py-2">
                                            Entregado
                                        </option>
                                    </select>
                                    <!-- Ícono de flecha personalizado -->
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones con mejor diseño -->
                            <div class="flex items-center justify-end space-x-4 pt-6">
                                <a href="{{ route('pedidos.listar') }}"
                                    class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium  
                                    hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300   
                                    transition-all duration-200">
                                    Cancelar
                                </a>
                                <button type="submit"
                                    class="px-6 py-3 bg-blue-600 text-white rounded-lg text-sm font-medium  
                                    hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500   
                                    focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg">
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
