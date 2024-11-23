@if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
        {{ session('error') }} ¿A dónde vas, papi?
    </div>
@endif
@extends('layouts.layout')

@section('content')
    <!-- Encabezado -->
    <div class="flex bg-customBeige pb-4 justify-between items-center">
        <div class="space-x-4">
            <ul class="text-gray-700 text-sm mt-4 space-y-2 ml-4 mb-4">
                <li>• Envíos rápidos</li>
                <li>• Sin suscripciones, sin compromisos</li>
                <li>• Platos a partir de S/ 10.00</li>
                <li>• Comida casera</li>
                <li>• Personaliza tus preferencias</li>
            </ul>
            <button class="bg-yellow-500 ml-20 text-white font-alfa py-2 px-4 rounded hover:bg-yellow-600">Pedir
                Ahora</button>
            <button class="bg-teal-500 text-white font-alfa py-2 px-4 rounded hover:bg-teal-600">Cómo
                Funciona</button>
        </div>
        <div>
            <h1 class="text-5xl font-lily text-customNaranja ml-24 text-center">Comer bien <br> es el primer paso <br> hacia
                el éxito
                académico.</h1>
        </div>
        <div>
            <img src="{{ asset('images/Platos.png') }}" alt="">
        </div>
    </div>
    <!-- Proceso de Pedido -->
    <div class="bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-semibold text-gray-800 text-center mt-4">Come bien en cuatro pasos</h2>
        <div class="py-10 mt-0 flex justify-center gap-16">
            <div>
                <p class="text-lg font-alfa text-center">1. Elige</p>
                <p class="text-gray-600 max-w-xs">
                    Busca entre nuestra variedad de platillos cada día.
                </p>
            </div>
            <div>
                <p class="text-lg font-alfa text-center">2. Preparación</p>
                <p class="text-gray-600 max-w-xs">
                    Nuestros cocineros cocinan para ti.
                </p>
            </div>
            <div>
                <p class="text-lg font-alfa text-center">3. Entrega</p>
                <p class="text-gray-600 max-w-xs">
                    Te lo enviamos a Tecsup en transporte refrigerado.
                </p>
            </div>
            <div>
                <p class="text-lg font-alfa text-center">4. Finalización</p>
                <p class="text-gray-600 max-w-xs">
                    Tu comida llega en el menor tiempo y no perderás mucho tiempo.
                </p>
            </div>
        </div>
    </div>


    <!-- Menús del Día -->
    <section class="py-10 bg-gray-50">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-6xl font-semibold font-charm text-customNaranja">Menú Del Día</h2>
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($productos as $producto)
                    <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow">
                        <img src="{{ asset($producto->imagen ?? 'images/currypollo_con_arroz.jpg') }}"
                            alt="{{ $producto->nombre }}" class="w-full h-32 object-cover rounded">
                        <a href="{{ route('producto.detalle', ['id' => $producto->id]) }}">
                            <h3 class="mt-4 text-lg font-semibold text-gray-800">{{ $producto->nombre }}</h3>
                        </a>
                        <p class="text-gray-500 text-sm">(450 gr)</p>
                        <p class="text-gray-900 font-bold mt-2">S/ {{ number_format($producto->precio, 2) }}</p>

                        @if (auth()->check())
                            <!-- Mostrar botón de añadir al carrito si está autenticado -->
                            <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-4">
                                @csrf
                                <input type="hidden" name="id" value="{{ $producto->id }}">
                                <button type="submit"
                                    class="w-full bg-yellow-500 text-white font-medium py-2 rounded hover:bg-yellow-600">
                                    Añadir
                                </button>
                            </form>
                        @else
                            <!-- Redirigir al login si no está autenticado -->
                            <a href="{{ route('login') }}"
                                class="block w-full mt-4 bg-red-500 text-white text-center font-medium py-2 rounded hover:bg-red-600">
                                Inicia sesión para añadir
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Beneficios -->
    <section class="py-10 bg-white">
        <div class="max-w-5xl mx-auto text-center">
            <!-- Título -->
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Beneficios de comer sano fuera de casa</h2>
            <!-- Contenedor de beneficios -->
            <div class="flex justify-between items-center">
                <div>
                    <div>
                        <div class="flex justify-center"><img src="{{ asset('images/plata.png') }}" alt=""></div>
                        <p class="font-bold text-gray-800 mb-16">Ahorra dinero</p>
                    </div>

                    <!-- Controla tus porciones -->
                    <div>
                        <div class="flex justify-center"><img src="{{ asset('images/comida.png') }}" alt=""></div>
                        <p class="font-bold text-gray-800">Controla tus porciones</p>
                    </div>
                </div>

                <!-- Imagen principal en el centro -->
                <div>
                    <img src="{{ asset('images/plato_central.png') }}" alt="Plato saludable"
                        class="w-40 h-40 rounded-full shadow-md">
                </div>

                <div>
                    <div>
                        <div class="flex justify-center"><img src="{{ asset('images/salud.png') }}" alt=""></div>
                        <p class="font-bold text-gray-800 mb-16">Mejora tu salud</p>
                    </div>

                    <!-- Ahorra tiempo -->
                    <div>
                        <div class="flex justify-center"><img src="{{ asset('images/hora.png') }}" alt=""></div>
                        <p class="font-bold text-gray-800">Ahorra tiempo</p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- Preguntas Frecuentes -->
    <section class="py-10 bg-gray-50">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl font-semibold font-crimson text-gray-800 mb-8">¿Tienes alguna duda?</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Pregunta 1 -->
                <div class="bg-white rounded-lg shadow-md p-4">
                    <button onclick="toggleAnswer(this)" class="flex justify-between w-full text-gray-700 font-semibold">
                        ¿Cómo hago mis pedidos?
                        <span class="text-gray-500">+</span>
                    </button>
                    <div
                        class="overflow-hidden transition-all duration-500 transform scale-95 opacity-0 max-h-0 mt-2 text-left">
                        <p class="text-gray-600">Puedes hacer tus pedidos directamente desde nuestra aplicación web o móvil
                            en pocos pasos.</p>
                    </div>
                </div>

                <!-- Pregunta 2 -->
                <div class="bg-white rounded-lg shadow-md p-4">
                    <button onclick="toggleAnswer(this)" class="flex justify-between w-full text-gray-700 font-semibold">
                        ¿Se puede hacer un cambio en el plato?
                        <span class="text-gray-500">+</span>
                    </button>
                    <div
                        class="overflow-hidden transition-all duration-500 transform scale-95 opacity-0 max-h-0 mt-2 text-left">
                        <p class="text-gray-600">Sí, puedes seleccionar una hora específica al realizar tu pedido, dentro de
                            nuestro horario disponible.</p>
                    </div>
                </div>

                <!-- Pregunta 3 -->
                <div class="bg-white rounded-lg shadow-md p-4">
                    <button onclick="toggleAnswer(this)" class="flex justify-between w-full text-gray-700 font-semibold">
                        ¿Puedo elegir una hora específica de entrega?
                        <span class="text-gray-500">+</span>
                    </button>
                    <div
                        class="overflow-hidden transition-all duration-500 transform scale-95 opacity-0 max-h-0 mt-2 text-left">
                        <p class="text-gray-600">Sí, nuestros menús son personalizables para adaptarse a tus necesidades
                            dietéticas.</p>
                    </div>
                </div>

                <!-- Pregunta 4 -->
                <div class="bg-white rounded-lg shadow-md p-4">
                    <button onclick="toggleAnswer(this)" class="flex justify-between w-full text-gray-700 font-semibold">
                        ¿Es un servicio de suscripción?
                        <span class="text-gray-500">+</span>
                    </button>
                    <div
                        class="overflow-hidden transition-all duration-500 transform scale-95 opacity-0 max-h-0 mt-2 text-left">
                        <p class="text-gray-600">Aceptamos pagos con tarjeta de crédito, débito y transferencias bancarias.
                        </p>
                    </div>
                </div>
                <!-- Pregunta 5 -->
                <div class="bg-white rounded-lg shadow-md p-4">
                    <button onclick="toggleAnswer(this)" class="flex justify-between w-full text-gray-700 font-semibold">
                        ¿Puedo adaptar los menús a mis necesidades?
                        <span class="text-gray-500">+</span>
                    </button>
                    <div
                        class="overflow-hidden transition-all duration-500 transform scale-95 opacity-0 max-h-0 mt-2 text-left">
                        <p class="text-gray-600">Sí, nuestros menús son personalizables para adaptarse a tus necesidades
                            dietéticas.</p>
                    </div>
                </div>
                <!-- Pregunta 6 -->
                <div class="bg-white rounded-lg shadow-md p-4">
                    <button onclick="toggleAnswer(this)" class="flex justify-between w-full text-gray-700 font-semibold">
                        ¿Qué hago si tengo algún inconveniente con mi pedido?
                        <span class="text-gray-500">+</span>
                    </button>
                    <div
                        class="overflow-hidden transition-all duration-500 transform scale-95 opacity-0 max-h-0 mt-2 text-left">
                        <p class="text-gray-600">Sí, nuestros menús son personalizables para adaptarse a tus necesidades
                            dietéticas.</p>
                    </div>
                </div>
                <!-- Pregunta 7 -->
                <div class="bg-white rounded-lg shadow-md p-4">
                    <button onclick="toggleAnswer(this)" class="flex justify-between w-full text-gray-700 font-semibold">
                        ¿Cuáles son los métodos de pago?
                        <span class="text-gray-500">+</span>
                    </button>
                    <div
                        class="overflow-hidden transition-all duration-500 transform scale-95 opacity-0 max-h-0 mt-2 text-left">
                        <p class="text-gray-600">Sí, nuestros menús son personalizables para adaptarse a tus necesidades
                            dietéticas.</p>
                    </div>
                </div>
                <!-- Pregunta 8 -->
                <div class="bg-white rounded-lg shadow-md p-4">
                    <button onclick="toggleAnswer(this)" class="flex justify-between w-full text-gray-700 font-semibold">
                        ¿Cómo controlan la calidad de la comida?
                        <span class="text-gray-500">+</span>
                    </button>
                    <div
                        class="overflow-hidden transition-all duration-500 transform scale-95 opacity-0 max-h-0 mt-2 text-left">
                        <p class="text-gray-600">Sí, nuestros menús son personalizables para adaptarse a tus necesidades
                            dietéticas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function toggleAnswer(button) {
            const answer = button.nextElementSibling;
            const isCollapsed = answer.style.maxHeight === '0px' || !answer.style.maxHeight;

            // Cierra solo la respuesta que ya está abierta dentro del mismo contenedor
            const parent = button.closest('.grid');
            parent.querySelectorAll('.overflow-hidden').forEach(div => {
                if (div !== answer) {
                    div.style.maxHeight = '0px';
                    div.style.opacity = '0';
                    div.style.transform = 'scale(0.95)';
                }
            });

            // Despliega o contrae la respuesta seleccionada
            if (isCollapsed) {
                const scrollHeight = answer.scrollHeight;
                answer.style.maxHeight = scrollHeight + 'px';
                answer.style.opacity = '1';
                answer.style.transform = 'scale(1)';
            } else {
                answer.style.maxHeight = '0px';
                answer.style.opacity = '0';
                answer.style.transform = 'scale(0.95)';
            }
        }
    </script>

    </body>

    </html>
@endsection