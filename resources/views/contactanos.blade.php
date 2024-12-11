@extends('layouts.layout')

@section('content')
    <section class="w-full min-h-screen flex items-center justify-center bg-cover bg-center bg-fixed p-4 md:p-0"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/fondito.jpg') }}');">
        <div class="bg-white bg-opacity-95 p-6 rounded-lg shadow-lg max-w-md w-full">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-1">Contáctenos</h2>
                <p class="text-sm text-gray-600">Complete el formulario y nos contactaremos</p>
            </div>

            <form action="{{ route('formulario.submit') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Nombre -->
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
                    <input id="nombre" name="nombre" type="text"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 text-sm"
                        placeholder="Ingrese su nombre" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                    <input id="email" name="email" type="email"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 text-sm"
                        placeholder="ejemplo@correo.com" required>
                </div>

                <!-- Asunto -->
                <div>
                    <label for="asunto" class="block text-sm font-medium text-gray-700 mb-1">Asunto</label>
                    <input id="asunto" name="asunto" type="text"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 text-sm"
                        placeholder="¿Cuál es el motivo de su contacto?" required>
                </div>

                <!-- Comentarios -->
                <div>
                    <label for="comentarios" class="block text-sm font-medium text-gray-700 mb-1">Mensaje</label>
                    <textarea id="comentarios" name="comentarios"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 text-sm resize-none"
                        placeholder="Escriba su mensaje aquí..." rows="4" required></textarea>
                </div>

                <!-- Botón de envío -->
                <button type="submit"
                    class="w-full px-4 py-2 bg-yellow-500 text-white rounded-md font-medium text-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-colors duration-200">
                    Enviar mensaje
                </button>
            </form>

            <!-- Información adicional -->
            <div class="mt-4 pt-4 border-t border-gray-200">
                <p class="text-center text-xs text-gray-500">
                    Al enviar este formulario, acepta que nos comuniquemos con usted.
                </p>
            </div>
        </div>
    </section>
@endsection
