@extends('layouts.layout')

@section('content')

    <!-- Encabezado -->
    <header class="bg-yellow-100 py-6 text-center">
        <div class="max-w-4xl mx-auto">
            <p class="text-lg font-semibold text-gray-700">Envíos a rápidos a todo Tecpsup Sin suscripciones, sin compromisos • Platos a partir de $10.00 • Comida casera • Personaliza tus preferencias</p>
            <h1 class="text-4xl font-bold text-orange-600 mt-2">Comer bien es el primer paso hacia el éxito académico.</h1>
            <div class="mt-4 flex justify-center space-x-4">
                <button class="bg-yellow-500 text-white font-semibold py-2 px-4 rounded hover:bg-yellow-600">Pedir Ahora</button>
                <button class="bg-teal-500 text-white font-semibold py-2 px-4 rounded hover:bg-teal-600">Cómo Funciona</button>
            </div>
        </div>
    </header>

    <!-- Proceso de Pedido -->
    <section class="py-10 bg-white">
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
            <button class="mt-8 bg-orange-500 text-white font-semibold py-2 px-6 rounded hover:bg-orange-600">¡Pídelo Ya!</button>
        </div>
    </section>

<!-- Menús del Día -->
<section class="py-10 bg-gray-50">
    <div class="max-w-5xl mx-auto text-center">
        <h2 class="text-3xl font-semibold text-orange-600">Menús Del Día</h2>
        <div class="mt-8 grid grid-cols-4 gap-6">
        <div class="mt-8 grid grid-cols-4 gap-6">
    @foreach($productos as $producto)
        <div class="bg-white rounded-lg shadow-md p-4">
            <img src="{{ asset($producto->imagen ?? 'images/default.png') }}" alt="{{ $producto->nombre }}" class="w-full h-32 object-cover rounded">
            <a href="{{ route('producto.detalle', ['id' => $producto->id]) }}">
                <h3 class="mt-4 text-lg font-semibold text-gray-700">{{ $producto->nombre }}</h3>
            </a>
            <p class="text-gray-500">(450 gr)</p>
            <p class="text-gray-800 font-bold">${{ number_format($producto->precio, 2) }}</p>
            <form action="{{ route('carrito.agregar') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $producto->id }}">
    <button type="submit" class="mt-4 bg-yellow-500 text-white font-semibold py-2 w-full rounded hover:bg-yellow-600">
        Añadir al carrito
    </button>
</form>
        </div>
    @endforeach
</div>

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
