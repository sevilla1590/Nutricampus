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
            <button class="bg-yellow-500 ml-20 text-white font-semibold py-2 px-4 rounded hover:bg-yellow-600">Pedir
                Ahora</button>
            <button class="bg-teal-500 text-white font-semibold py-2 px-4 rounded hover:bg-teal-600">Cómo
                Funciona</button>
        </div>
        <div>
            <h1 class="text-5xl font-lily text-customNaranja ml-24 text-center">Comer bien <br> es el primer paso <br> hacia el éxito
                académico.</h1>
        </div>
        <div>
            <img src="{{ asset('images/Platos.png') }}" alt="">
        </div>
    </div>
    <!-- Proceso de Pedido -->
    <section class="py-10 mt-0">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-2xl font-semibold text-gray-800">Come bien en cuatro pasos</h2>
            <div class="mt-6 grid grid-cols-4 gap-4 text-center">
                <div>
                    <p class="font-semibold text-lg">1. Elige</p>
                    <p class="text-gray-600">Busca entre nuestra variedad de platillos cada día.</p>
                </div>
                <div>
                    <p class="font-semibold text-lg">2. Preparación</p>
                    <p class="text-gray-600">Nuestros cocineros cocinan para ti.</p>
                </div>
                <div>
                    <p class="font-semibold text-lg">3. Entrega</p>
                    <p class="text-gray-600">Te lo enviamos a tiempo con el transporte adecuado.</p>
                </div>
                <div>
                    <p class="font-semibold text-lg">4. Finalización</p>
                    <p class="text-gray-600">Te lo llevas a casa en el menor tiempo posible.</p>
                </div>
            </div>
            <button class="mt-8 bg-orange-500 text-white font-semibold py-2 px-6 rounded hover:bg-orange-600">¡Pídelo
                Ya!</button>
        </div>
    </section>

    <!-- Menús del Día -->
    <section class="py-10 bg-gray-50">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl font-semibold text-orange-600">Menús Del Día</h2>
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($productos as $producto)
                    <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow">
                        <img src="{{ asset($producto->imagen ?? 'images/default.png') }}" alt="{{ $producto->nombre }}"
                            class="w-full h-32 object-cover rounded">
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
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-semibold text-gray-800">Beneficios de comer sano fuera de casa</h2>
            <div class="flex justify-center space-x-10 mt-8">
                <div class="text-center">
                    <img src="save_money_icon.png" alt="Ahorra dinero" class="w-12 h-12 mx-auto mb-2">
                    <p class="font-semibold text-gray-700">Ahorra dinero</p>
                </div>
                <div class="text-center">
                    <img src="control_portions_icon.png" alt="Controla tus porciones" class="w-12 h-12 mx-auto mb-2">
                    <p class="font-semibold text-gray-700">Controla tus porciones</p>
                </div>
                <div class="text-center">
                    <img src="improve_health_icon.png" alt="Mejora tu salud" class="w-12 h-12 mx-auto mb-2">
                    <p class="font-semibold text-gray-700">Mejora tu salud</p>
                </div>
                <div class="text-center">
                    <img src="save_time_icon.png" alt="Ahorra tiempo" class="w-12 h-12 mx-auto mb-2">
                    <p class="font-semibold text-gray-700">Ahorra tiempo</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Preguntas Frecuentes -->
    <section class="py-10 bg-gray-50">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl font-semibold text-gray-800 mb-8">¿Tienes alguna duda?</h2>
            <div class="grid grid-cols-2 gap-4">
                <!-- Pregunta frecuente -->
                <div class="bg-white rounded-lg shadow-md p-4 text-left">
                    <button class="flex justify-between w-full text-gray-700 font-semibold">
                        ¿Cómo hago mis pedidos?
                        <span class="text-gray-500">+</span>
                    </button>
                </div>
                <!-- Repetir para más preguntas frecuentes -->
                <div class="bg-white rounded-lg shadow-md p-4 text-left">
                    <button class="flex justify-between w-full text-gray-700 font-semibold">
                        ¿Puedo elegir una hora específica de entrega?
                        <span class="text-gray-500">+</span>
                    </button>
                </div>
                <!-- Añade más preguntas siguiendo el mismo formato -->
            </div>
        </div>
    </section>

    </body>

    </html>
@endsection