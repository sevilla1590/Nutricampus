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
            <a href="#platillos">
                <button class="bg-yellow-500 ml-2 text-white font-alfa py-2 px-4 rounded hover:bg-yellow-600">
                    Pedir Ahora
                </button>
            </a>
            <a href="{{ route('nuestros-servicios') }}">
                <button class="bg-teal-500 text-white font-alfa py-2 px-4 rounded hover:bg-teal-600">
                    Nuestros Servicios
                </button>
            </a>
        </div>
        <div>
            <h1 class="text-5xl font-lily text-customNaranja ml-24 text-center">Comer bien <br> es el primer paso <br> hacia
                el éxito académico.</h1>
        </div>
        <div>
            <img src="{{ asset('images/Platos.png') }}" alt="">
        </div>
    </div>

    <!-- Proceso de Pedido -->
    <div class="bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-bold font-fraunces text-gray-800 text-center mt-4">COME BIEN EN CUATRO PASOS</h2>
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
    <section id="platillos" class="py-10 bg-gray-50">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-6xl font-semibold font-charm text-customNaranja">Menú Del Día</h2>
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($productos as $producto)
                    <div class="relative bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow">
                        @if ($producto->disponibilidad <= 0)
                            <div
                                class="absolute inset-0 bg-gray-500 bg-opacity-50 rounded-lg flex items-center justify-center z-10">
                                <span class="text-white font-bold text-lg bg-red-500 px-4 py-1 rounded">Agotado</span>
                            </div>
                        @endif
                        <img src="{{ asset('images/' . $producto->id . '.jpg') }}" alt="{{ $producto->nombre }}"
                            class="w-full h-32 object-cover rounded">
                        <a href="{{ route('producto.detalle', ['id' => $producto->id]) }}">
                            <h3 class="mt-4 text-lg font-semibold text-gray-800">{{ $producto->nombre }}</h3>
                        </a>
                        <p class="text-gray-500 text-sm">(450 gr)</p>
                        <p class="text-gray-900 font-bold mt-2">S/ {{ number_format($producto->precio, 2) }}</p>
                        @if ($producto->disponibilidad > 0)
                            @if (auth()->check())
                                <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $producto->id }}">
                                    <button type="submit"
                                        class="w-full bg-yellow-500 text-white font-medium py-2 rounded hover:bg-yellow-600">
                                        Añadir
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}"
                                    class="block w-full mt-4 bg-red-500 text-white text-center font-medium py-2 rounded hover:bg-red-600">
                                    Inicia sesión para añadir
                                </a>
                            @endif
                        @else
                            <button class="w-full bg-gray-400 text-white font-medium py-2 rounded cursor-not-allowed mt-4"
                                disabled>
                                Agotado
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Beneficios -->
    <section class="py-10 bg-white">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl font-bold font-interTight text-gray-900 mb-6">Beneficios de comer sano fuera de casa</h2>
            <div class="flex justify-between items-center">
                <div>
                    <div>
                        <div class="flex justify-center"><img src="{{ asset('images/plata.png') }}" alt=""></div>
                        <p class="font-bold text-gray-800 mb-24">Ahorra dinero</p>
                    </div>
                    <div>
                        <div class="flex justify-center"><img src="{{ asset('images/comida.png') }}" alt=""></div>
                        <p class="font-bold text-gray-800 mb-24">Controla tus porciones</p>
                    </div>
                </div>
                <div>
                    <img src="{{ asset('images/plato_central.png') }}" alt="Plato saludable"
                        class="w-60 h-60 rounded-full shadow-md">
                </div>
                <div>
                    <div>
                        <div class="flex justify-center"><img src="{{ asset('images/salud.png') }}" alt=""></div>
                        <p class="font-bold text-gray-800 mb-24">Mejora tu salud</p>
                    </div>
                    <div>
                        <div class="flex justify-center"><img src="{{ asset('images/hora.png') }}" alt=""></div>
                        <p class="font-bold text-gray-800 mb-24">Ahorra tiempo</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Preguntas Frecuentes -->
    <section id="preguntas" class="py-10 bg-gray-50">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl font-semibold font-crimson text-gray-800 mb-8">¿Tienes alguna duda?</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Preguntas frecuentes -->
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
                        <p class="text-gray-600">Sí, en Nutricampus puedes personalizar tu plato al momento de realizar la
                            reserva, ajustándolo a tus preferencias y necesidades alimenticias.</p>
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
                        <p class="text-gray-600">Sí, puedes seleccionar una hora específica al realizar tu pedido, dentro de
                            nuestro horario disponible.</p>
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
                        <p class="text-gray-600">No, Nutricampus no es un servicio de suscripción. Los estudiantes realizan
                            reservas y pagos individuales para cada pedido, ofreciendo flexibilidad según sus necesidades y
                            horarios.</p>
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
                        <p class="text-gray-600">Si tienes un inconveniente con tu pedido, puedes contactarnos directamente
                            a través de la plataforma web o móvil, donde encontrarás soporte para resolver cualquier
                            problema de manera rápida y eficiente.</p>
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
                        <p class="text-gray-600">Los métodos de pago de Nutricampus incluyen opciones accesibles desde la
                            plataforma web o móvil, permitiendo pagos seguros y eficientes al momento de realizar la
                            reserva.</p>
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
                        <p class="text-gray-600">En Nutricampus controlamos la calidad de la comida seleccionando
                            ingredientes frescos y saludables, y trabajando con estándares estrictos en la preparación para
                            garantizar seguridad y sabor en cada pedido.</p>
                    </div><!-- Más preguntas aquí -->
                </div>
            </div>
    </section>

    <script>
        function toggleAnswer(button) {
            const answer = button.nextElementSibling;
            const isCollapsed = answer.style.maxHeight === '0px' || !answer.style.maxHeight;

            const parent = button.closest('.grid');
            parent.querySelectorAll('.overflow-hidden').forEach(div => {
                if (div !== answer) {
                    div.style.maxHeight = '0px';
                    div.style.opacity = '0';
                    div.style.transform = 'scale(0.95)';
                }
            });

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
@endsection
