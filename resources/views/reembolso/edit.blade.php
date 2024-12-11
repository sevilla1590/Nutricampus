@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gray-200 py-8 w-full">
        <div class="max-w-3xl mx-auto">
            <!-- Encabezado con sombra -->
            <br>
            <br>
            <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                    Editar Reembolso
                </h1>
                <p class="mt-2 text-sm text-gray-600">
                    Actualiza el estado y la respuesta del reembolso
                </p>
            </div>

            <!-- Formulario con sombra -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <form action="{{ route('reembolsos.update', $reembolso->id_reembolso) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Campo Estado -->
                    <div class="space-y-2">
                        <label for="estado" class="text-sm font-medium text-gray-700 block">
                            Estado del Reembolso
                        </label>
                        <div class="relative">
                            <select name="estado" id="estado"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200 text-sm">
                                <option value="enviado" {{ $reembolso->estado == 'enviado' ? 'selected' : '' }}>
                                    📩 Enviado
                                </option>
                                <option value="aprobado" {{ $reembolso->estado == 'aprobado' ? 'selected' : '' }}>
                                    ✅ Aprobado
                                </option>
                                <option value="rechazado" {{ $reembolso->estado == 'rechazado' ? 'selected' : '' }}>
                                    ❌ Rechazado
                                </option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Campo Respuesta -->
                    <div class="space-y-2">
                        <label for="respuesta" class="text-sm font-medium text-gray-700 block">
                            Respuesta al Reembolso
                        </label>
                        <textarea name="respuesta" id="respuesta" rows="4"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200 text-sm"
                            placeholder="Ingrese una respuesta detallada...">{{ old('respuesta', $reembolso->respuesta) }}</textarea>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                        <a href="{{ route('reembolsos.index') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Volver
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>

            <!-- Mensaje de Ayuda -->
            <div class="mt-6 bg-blue-50 rounded-lg p-4 shadow-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">
                            Información Importante
                        </h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <p>
                                Asegúrese de proporcionar una respuesta clara y detallada al actualizar el estado del
                                reembolso.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
