@extends('layouts.layout')

@section('content')
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-4 mt-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Encabezado -->
    <div class="bg-customBeige py-6 px-4">
        <div class="container mx-auto flex flex-col lg:flex-row justify-between items-center gap-8">
            <!-- Beneficios y botones -->
            <div class="w-full lg:w-1/3 space-y-4">
                <ul class="text-gray-700 text-sm space-y-2">
                    <li class="flex items-center"><span class="mr-2">•</span> Envíos rápidos</li>
                    <li class="flex items-center"><span class="mr-2">•</span> Sin suscripciones, sin compromisos</li>
                    <li class="flex items-center"><span class="mr-2">•</span> Platos a partir de S/ 10.00</li>
                    <li class="flex items-center"><span class="mr-2">•</span> Comida casera</li>
                    <li class="flex items-center"><span class="mr-2">•</span> Personaliza tus preferencias</li>
                </ul>
                <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                    <a href="#platillos">
                        <button
                            class="bg-yellow-500 text-white font-alfa py-2 px-4 rounded hover:bg-yellow-600 transition-colors">
                            Pedir Ahora
                        </button>
                    </a>
                    <a href="{{ route('nuestros-servicios') }}">
                        <button
                            class="bg-teal-500 text-white font-alfa py-2 px-4 rounded hover:bg-teal-600 transition-colors">
                            Nuestros Servicios
                        </button>
                    </a>
                </div>
            </div>

            <!-- Título central -->
            <div class="w-full lg:w-1/3 text-center">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-lily text-customNaranja leading-relaxed">
                    Comer bien <br> es el primer paso <br> hacia el éxito académico.
                </h1>
            </div>

            <!-- Imagen -->
            <div class="w-full lg:w-1/3 flex justify-center">
                <img src="{{ asset('images/Platos.png') }}" alt="Platos" class="max-w-full h-auto">
            </div>
        </div>
    </div>
    <br>
    <br>
    <!-- Proceso de Pedido -->
    <div class="bg-white shadow-lg rounded-lg p-4 md:p-8 mx-4 -mt-4">
        <h2 class="text-xl md:text-2xl font-bold font-fraunces text-gray-800 text-center mb-6">
            COME BIEN EN CUATRO PASOS
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
            <div class="text-center p-4">
                <p class="text-lg font-alfa mb-2">1. Elige</p>
                <p class="text-gray-600">Busca entre nuestra variedad de platillos cada día.</p>
            </div>
            <div class="text-center p-4">
                <p class="text-lg font-alfa mb-2">2. Preparación</p>
                <p class="text-gray-600">Nuestros cocineros cocinan para ti.</p>
            </div>
            <div class="text-center p-4">
                <p class="text-lg font-alfa mb-2">3. Entrega</p>
                <p class="text-gray-600">Te lo enviamos a Tecsup en transporte refrigerado.</p>
            </div>
            <div class="text-center p-4">
                <p class="text-lg font-alfa mb-2">4. Finalización</p>
                <p class="text-gray-600">Tu comida llega en el menor tiempo posible.</p>
            </div>
        </div>
    </div>

    <!-- Menús del Día -->
    <section id="platillos" class="py-10 bg-gray-50 px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-semibold font-charm text-customNaranja text-center mb-8">
                Menú Del Día
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($productos as $producto)
                    <div class="relative bg-white rounded-lg shadow-md p-4 hover:shadow-xl transition-all duration-300">
                        @if ($producto->disponibilidad <= 0)
                            <div
                                class="absolute inset-0 bg-gray-500 bg-opacity-50 rounded-lg flex items-center justify-center z-10">
                                <span class="text-white font-bold text-lg bg-red-500 px-4 py-1 rounded">Agotado</span>
                            </div>
                        @endif
                        <img src="{{ asset('images/' . $producto->id . '.jpg') }}" alt="{{ $producto->nombre }}"
                            class="w-full h-48 object-cover rounded-lg">
                        <div class="mt-4">
                            <a href="{{ route('producto.detalle', ['id' => $producto->id]) }}"
                                class="block hover:text-customNaranja transition-colors">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $producto->nombre }}</h3>
                            </a>
                            <p class="text-gray-500 text-sm mt-1">(450 gr)</p>
                            <p class="text-gray-900 font-bold mt-2">S/ {{ number_format($producto->precio, 2) }}</p>

                            @if ($producto->disponibilidad > 0)
                                @if (auth()->check())
                                    <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-4">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $producto->id }}">
                                        <button type="submit"
                                            class="w-full bg-yellow-500 text-white font-medium py-2 rounded hover:bg-yellow-600 transition-colors">
                                            Añadir
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="block w-full mt-4 bg-red-500 text-white text-center font-medium py-2 rounded hover:bg-red-600 transition-colors">
                                        Inicia sesión para añadir
                                    </a>
                                @endif
                            @else
                                <button
                                    class="w-full bg-gray-400 text-white font-medium py-2 rounded cursor-not-allowed mt-4"
                                    disabled>
                                    Agotado
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Beneficios -->
    <section class="py-10 bg-white px-4">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-bold font-interTight text-gray-900 text-center mb-8">
                Beneficios de comer sano fuera de casa
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                <!-- Columna izquierda -->
                <div class="space-y-8">
                    <div class="text-center">
                        <div class="flex justify-center mb-4">
                            <img src="{{ asset('images/plata.png') }}" alt="Ahorro" class="h-16 w-auto">
                        </div>
                        <p class="font-bold text-gray-800">Ahorra dinero</p>
                    </div>
                    <div class="text-center">
                        <div class="flex justify-center mb-4">
                            <img src="{{ asset('images/comida.png') }}" alt="Porciones" class="h-16 w-auto">
                        </div>
                        <p class="font-bold text-gray-800">Controla tus porciones</p>
                    </div>
                </div>

                <!-- Imagen central -->
                <div class="flex justify-center py-8 md:py-0">
                    <img src="{{ asset('images/plato_central.png') }}" alt="Plato saludable"
                        class="w-48 h-48 md:w-60 md:h-60 rounded-full shadow-md">
                </div>

                <!-- Columna derecha -->
                <div class="space-y-8">
                    <div class="text-center">
                        <div class="flex justify-center mb-4">
                            <img src="{{ asset('images/salud.png') }}" alt="Salud" class="h-16 w-auto">
                        </div>
                        <p class="font-bold text-gray-800">Mejora tu salud</p>
                    </div>
                    <div class="text-center">
                        <div class="flex justify-center mb-4">
                            <img src="{{ asset('images/hora.png') }}" alt="Tiempo" class="h-16 w-auto">
                        </div>
                        <p class="font-bold text-gray-800">Ahorra tiempo</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Preguntas Frecuentes -->
    <section id="preguntas" class="py-10 bg-gray-50 px-4">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-semibold font-crimson text-gray-800 text-center mb-8">
                ¿Tienes alguna duda?
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Preguntas -->
                <div class="bg-white rounded-lg shadow-md p-4">
                    <button onclick="toggleAnswer(this)"
                        class="flex justify-between w-full text-gray-700 font-semibold hover:text-customNaranja transition-colors">
                        ¿Cómo hago mis pedidos?
                        <span class="text-gray-500">+</span>
                    </button>
                    <div class="overflow-hidden transition-all duration-300 max-h-0 opacity-0">
                        <p class="text-gray-600 mt-2">
                            Puedes hacer tus pedidos directamente desde nuestra aplicación web o móvil en pocos pasos.
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-4">
                    <button onclick="toggleAnswer(this)"
                        class="flex justify-between w-full text-gray-700 font-semibold hover:text-customNaranja transition-colors">
                        ¿Cómo hago mis pedidos?
                        <span class="text-gray-500">+</span>
                    </button>
                    <div class="overflow-hidden transition-all duration-300 max-h-0 opacity-0">
                        <p class="text-gray-600 mt-2">
                            Puedes hacer tus pedidos directamente desde nuestra aplicación web o móvil en pocos pasos.
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-4">
                    <button onclick="toggleAnswer(this)"
                        class="flex justify-between w-full text-gray-700 font-semibold hover:text-customNaranja transition-colors">
                        ¿Cómo hago mis pedidos?
                        <span class="text-gray-500">+</span>
                    </button>
                    <div class="overflow-hidden transition-all duration-300 max-h-0 opacity-0">
                        <p class="text-gray-600 mt-2">
                            Puedes hacer tus pedidos directamente desde nuestra aplicación web o móvil en pocos pasos.
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-4">
                    <button onclick="toggleAnswer(this)"
                        class="flex justify-between w-full text-gray-700 font-semibold hover:text-customNaranja transition-colors">
                        ¿Cómo hago mis pedidos?
                        <span class="text-gray-500">+</span>
                    </button>
                    <div class="overflow-hidden transition-all duration-300 max-h-0 opacity-0">
                        <p class="text-gray-600 mt-2">
                            Puedes hacer tus pedidos directamente desde nuestra aplicación web o móvil en pocos pasos.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function toggleAnswer(button) {
            const answer = button.nextElementSibling;
            const isCollapsed = answer.style.maxHeight === '0px' || !answer.style.maxHeight;

            // Cerrar todas las respuestas abiertas  
            document.querySelectorAll('.overflow-hidden').forEach(div => {
                if (div !== answer) {
                    div.style.maxHeight = '0px';
                    div.style.opacity = '0';
                }
            });

            // Alternar la respuesta actual  
            if (isCollapsed) {
                answer.style.maxHeight = answer.scrollHeight + 'px';
                answer.style.opacity = '1';
            } else {
                answer.style.maxHeight = '0px';
                answer.style.opacity = '0';
            }
        }
    </script>
@endsection
