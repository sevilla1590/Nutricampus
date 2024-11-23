@extends('layouts.layout')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-12">
    <!-- Título -->
    <div class="text-center mb-10">
        <h1 class="text-4xl font-bold font-interTight text-gray-800">Quiénes somos</h1>
        <p class="text-gray-500 text-lg italic">Conoce más sobre nosotros</p>
    </div>

    <!-- Contenido -->
    <div class="bg-gray-100 rounded-lg shadow-lg p-8 grid grid-cols-1 lg:grid-cols-2 items-center gap-6">
        <!-- Texto -->
        <div>
            <p class="text-gray-700 mb-4 font-fraunces">
                En Nutricampus, nos especializamos en brindar soluciones de alimentación saludable para los estudiantes
                de Tecsup - Lima, a través de una plataforma digital innovadora. Ofrecemos comida personalizada que se
                adapta
                a los horarios y necesidades de cada usuario, combinando conveniencia, calidad y accesibilidad.
            </p>
            <p class="text-gray-700 mb-4 font-fraunces">
                Nuestra misión es promover un estilo de vida saludable en la comunidad estudiantil, con opciones
                prácticas, el
                acompañamiento de nutricionistas y consejos útiles. A través de nuestra web y app móvil, facilitamos la
                gestión
                de pedidos y pagos, garantizando una experiencia confiable y eficiente.
            </p>
            <p class="text-gray-700 font-fraunces">
                En Nutricampus, queremos ser tu aliado en el camino hacia una mejor alimentación, ayudándote a cuidar de
                tu
                bienestar mientras sigues tu ritmo de vida. ¡Descubre cómo hacer más fácil y saludable tu día a día con
                nosotros!
            </p>
        </div>

        <!-- Imagen -->
        <div class="flex justify-center">
            <img src="{{ asset('images/chinito.png') }}" alt="Equipo Nutricampus" class="rounded-lg shadow-2xl p-4">
        </div>
    </div>

@endsection