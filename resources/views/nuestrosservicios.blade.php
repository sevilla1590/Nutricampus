@extends('layouts.layout')

@section('content')
<section class="py-16 bg-gray-50">
    <br>
    <div class="max-w-6xl mx-auto text-center">
        <h1 class="text-4xl font-bold font-interTight text-gray-800">Nuestros Servicios</h1>
        <p class="text-lg text-gray-600 mt-4 font-montserrat font-semibold">Te ayudamos a mantener una alimentación saludable y equilibrada.</p>
    </div>
    <br>
    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
        <!-- Tarjeta 1 -->
        <div class="bg-white shadow-md rounded-lg p-6 flex items-center space-x-4">
            <div class="flex-1">
                <h2 class="text-xl font-bold font-fraunces text-gray-800">Entrega Diaria de Comidas Frescas</h2>
                <p class="text-gray-600 mt-2 font-montserrat">
                    Nuestro compromiso es brindarte alimentos frescos y nutritivos todos los días. Cada mañana, preparamos
                    y empaquetamos cuidadosamente nuestras comidas para asegurarnos de que lleguen a tu campus en óptimas
                    condiciones. Olvídate del estrés de cocinar y planificar tus comidas; nosotros nos encargamos de todo.
                </p>
            </div>
            <img src="{{ asset('images/fresca.jpg') }}" alt="Entrega diaria" class="w-32 h-32 object-cover rounded-lg">
        </div>

        <!-- Tarjeta 2 -->
        <div class="bg-white shadow-md rounded-lg p-6 flex items-center space-x-4">
            <div class="flex-1">
                <h2 class="text-xl font-bold font-fraunces text-gray-800">Menú Variado y Delicioso</h2>
                <p class="text-gray-600 mt-2 font-montserrat">
                    Disfruta de una amplia variedad de platos deliciosos que cambian semanalmente. Desde ensaladas frescas
                    y coloridas hasta platos principales llenos de sabor y nutrientes, nuestro menú está diseñado para
                    satisfacer todos los paladares sin comprometer la salud.
                </p>
            </div>
            <img src="{{ asset('images/variado.jpg') }}" alt="Menú variado" class="w-32 h-32 object-cover rounded-lg">
        </div>

        <!-- Tarjeta 3 -->
        <div class="bg-white shadow-md rounded-lg p-6 flex items-center space-x-4">
            <div class="flex-1">
                <h2 class="text-xl font-bold font-fraunces text-gray-800">Opciones para Dietas Especiales</h2>
                <p class="text-gray-600 mt-2 font-montserrat">
                    Entendemos que cada estudiante tiene preferencias y necesidades dietéticas específicas. Ofrecemos
                    opciones para dietas vegetarianas, veganas, sin gluten y muchas más. Nuestro objetivo es asegurarnos de
                    que todos puedan disfrutar de comidas saludables y deliciosas.
                </p>
            </div>
            <img src="{{ asset('images/dietas.jpg') }}" alt="Dietas especiales" class="w-32 h-32 object-cover rounded-lg">
        </div>
    </div>
    <br>
    <br>
</section>
@endsection