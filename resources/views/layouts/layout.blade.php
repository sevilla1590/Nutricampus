@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutricampus</title>
    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    <!-- Font Awesome para los iconos de redes sociales y pago -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<!-- Header -->
<header class="bg-teal-700 flex items-center justify-between px-8 py-4">
    <div class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="Nutricampus Logo" class="h-16">
    </div>
    
    <form class="flex-1 flex justify-center" action="#" method="GET">
        <input type="text" class="w-3/5 py-2 px-4 rounded-full bg-gray-200 text-gray-600 placeholder-gray-500" placeholder="Buscar en la pagina...">
    </form>

    <nav class="flex space-x-8">
        <a href="#" class="text-white font-bold uppercase hover:text-yellow-400">Platos del día</a>
        <a href="#" class="text-white font-bold uppercase hover:text-yellow-400">Servicios</a>
        <a href="#" class="text-white font-bold uppercase hover:text-yellow-400">Contáctanos</a>
        <a href="#" class="text-white font-bold uppercase hover:text-yellow-400">FAQ</a>
    </nav>

    <div class="flex items-center space-x-4">
        <!-- Verificar si el usuario está autenticado -->
        @auth
            <div class="relative">
                <!-- Botón con el nombre del usuario y un ícono de flecha -->
                <button class="flex items-center bg-green-500 text-white px-3 py-2 rounded focus:outline-none" id="userMenuButton">
                    <i class="fas fa-user text-xl mr-2"></i>
                    {{ Auth::user()->name }}
                    <i class="fas fa-chevron-down ml-1"></i>
                </button>
                
                <!-- Menú desplegable -->
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden" id="userMenu">
                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Preferencias</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Cerrar sesión</button>
                    </form>
                </div>
            </div>
        @else
            <!-- Enlace de inicio de sesión si el usuario no está autenticado -->
            <a href="{{ route('login') }}" class="text-white flex flex-col items-center">
                <i class="fas fa-user text-2xl"></i>
                <span class="text-sm">Iniciar sesión</span>
            </a>
        @endauth
        
        <!-- Icono de carrito con contador -->
        <div class="relative">
            <a href="{{ route('carrito.ver') }}" class="text-white flex flex-col items-center hover:text-yellow-400">
                <i class="fas fa-shopping-cart text-2xl"></i>
                <span class="text-sm">Carrito</span>
            </a>
            
            <!-- Badge de contador -->
            @if(session('carrito') && count(session('carrito')) > 0)
                <span class="absolute bottom-0 right-0 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                    {{ count(session('carrito')) }}
                </span>
            @endif
        </div>
    </div>
</header>

<!-- Main Content Section -->
<main class="py-8">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-teal-700 text-white py-8">
    <div class="max-w-6xl mx-auto px-8 flex flex-wrap justify-between space-y-4 lg:space-y-0">
        <!-- Logo y redes sociales -->
        <div class="flex flex-col items-center lg:items-start">
            <img src="{{ asset('images/logo_footer.png') }}" alt="Nutricampus Logo" class="h-12 mb-2">
            <p class="font-bold mb-2">Visita nuestras redes</p>
            <div class="flex space-x-4">
                <a href="#" class="text-white text-2xl hover:text-yellow-400"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-white text-2xl hover:text-yellow-400"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white text-2xl hover:text-yellow-400"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>

        <!-- Empresa -->
        <div>
            <h3 class="font-bold text-lg mb-2">Empresa</h3>
            <ul class="space-y-1">
                <li><a href="#" class="hover:underline">¿Quiénes somos?</a></li>
                <li><a href="#" class="hover:underline">¿Cómo funciona?</a></li>
                <li><a href="#" class="hover:underline">Seguimientos de envíos</a></li>
                <li><a href="#" class="hover:underline">Trabaja con nosotros</a></li>
            </ul>
        </div>

        <!-- Servicios -->
        <div>
            <h3 class="font-bold text-lg mb-2">Servicios</h3>
            <ul class="space-y-1">
                <li><a href="#" class="hover:underline">Platillos del día</a></li>
                <li><a href="#" class="hover:underline">Completos</a></li>
            </ul>
        </div>

        <!-- Contacto -->
        <div>
            <h3 class="font-bold text-lg mb-2">Contáctanos</h3>
            <p>(01) 777-4343</p>
            <p>info@nutricampus.com</p>
        </div>

        <!-- Medios de pago -->
        <div class="flex flex-col items-center lg:items-start">
            <h3 class="font-bold text-lg mb-2">Medios de Pago</h3>
            <div class="flex space-x-4">
                <i class="fab fa-cc-mastercard text-4xl"></i>
                <i class="fab fa-cc-visa text-4xl"></i>
            </div>
        </div>
    </div>
    <div class="text-center mt-8">
        <span class="font-bold">&copy; 2024 Nutricampus. Todos los derechos reservados.</span>
    </div>
</footer>

<!-- JavaScript para el menú desplegable del usuario -->
<script>
    document.getElementById('userMenuButton').addEventListener('click', function () {
        const userMenu = document.getElementById('userMenu');
        userMenu.classList.toggle('hidden');
    });

    // Cerrar el menú cuando se hace clic fuera de él
    document.addEventListener('click', function (event) {
        const userMenu = document.getElementById('userMenu');
        const button = document.getElementById('userMenuButton');
        
        if (!button.contains(event.target) && !userMenu.contains(event.target)) {
            userMenu.classList.add('hidden');
        }
    });
</script>

</body>
</html>
