@extends('layouts.layout')

@section('content')
    <section class="w-full min-h-screen flex items-center justify-center bg-cover bg-center m-0"
        style="background-image: url('{{ asset('images/fondoformulario.jpg') }}');">
        <div class="bg-white bg-opacity-90 p-12 rounded-lg shadow-lg max-w-2xl w-full">
            <h2 class="text-3xl font-bold mb-6 text-center">Envíe su formulario</h2>
            <form action="{{ route('formulario.submit') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="nombre" class="block text-lg font-semibold mb-1">Nombre:</label>
                    <input id="nombre" name="nombre" type="text" class="w-full border rounded p-3 text-lg"
                        placeholder="Ingrese su nombre" required>
                </div>
                <div>
                    <label for="email" class="block text-lg font-semibold mb-1">Email:</label>
                    <input id="email" name="email" type="email" class="w-full border rounded p-3 text-lg"
                        placeholder="Ingrese su email" required>
                </div>
                <div>
                    <label for="asunto" class="block text-lg font-semibold mb-1">Asunto:</label>
                    <input id="asunto" name="asunto" type="text" class="w-full border rounded p-3 text-lg"
                        placeholder="Ingrese el asunto" required>
                </div>
                <div>
                    <label for="comentarios" class="block text-lg font-semibold mb-1">Comentarios:</label>
                    <textarea id="comentarios" name="comentarios" class="w-full border rounded p-3 text-lg"
                        placeholder="Ingrese sus comentarios" rows="6" required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit"
                        class="bg-yellow-500 text-white text-lg font-bold py-3 px-8 rounded hover:bg-yellow-600">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection