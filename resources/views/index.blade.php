@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="en" class="!scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutricampus</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lily+Script+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Charm&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    <!-- Font Awesome para los iconos de redes sociales y pago -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Header -->
    <header class="bg-teal-700 flex items-center py-4">
        <div class="flex px-8 space-x-32">
            <!-- Logo -->
            <div class="inline">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/NutricampusLogo.png') }}" alt="Nutricampus Logo" class="h-16">
                </a>
            </div>

            <div class="flex items-center">
                <ul class="flex space-x-48 text-white font-bold uppercase">
                    <li><a href="#platillos" class="hover:text-yellow-400">Platos del día</a></li>
                    <li><a href="{{ route('mis.pedidos') }}" class="hover:text-yellow-400">Mis pedidos</a></li>
                    <li><a href="{{ route('contactanos') }}" class="hover:text-yellow-400">Contáctanos</a></li>
                    <li><a href="#preguntas" class="hover:text-yellow-400">FAQ</a></li>
                </ul>
            </div>

            <!-- Iconos de usuario y carrito -->
            <div class="flex items-center space-x-6">
                <!-- Verificar si el usuario está autenticado -->
                @auth
                    <div class="relative">
                        <!-- Menú de usuario -->
                        <button class="flex items-center bg-green-500 text-white px-3 py-2 rounded focus:outline-none"
                            id="userMenuButton">
                            <i class="fas fa-user text-xl mr-2"></i>
                            {{ Auth::user()->name }}
                            <i class="fas fa-chevron-down ml-1"></i>
                        </button>

                        <!-- Menú desplegable -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden" id="userMenu">
                            <a href="{{ route('profile.show') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Preferencias</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Cerrar
                                    sesión</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-white flex flex-col items-center hover:text-yellow-400"">
                        <i class="fas fa-user text-2xl"></i>
                        <span class="text-sm hover:text-yellow-400">Iniciar sesión</span>
                    </a>
                @endauth

                <!-- Icono de carrito con contador -->
                <div class="relative">
                    <a href="{{ route('carrito.ver') }}"
                        class="text-white flex flex-col items-center hover:text-yellow-400">
                        <i class="fas fa-shopping-cart text-2xl"></i>
                        <span class="text-sm">Carrito</span>
                    </a>

                    <!-- Badge de contador -->
                    @if (session('carrito') && count(session('carrito')) > 0)
                        <span
                            class="absolute bottom-0 right-0 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                            {{ count(session('carrito')) }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content Section -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-teal-700 text-white py-8">
        <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-5 gap-6 px-8">
            <!-- Logo y redes sociales -->
            <div class="flex flex-col items-center md:items-start">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/NutricampusLogo.png') }}" alt="Nutricampus Logo" class="h-16 mb-4">
                </a>
                <p class="font-bold mb-4 text-center md:text-left">Visita nuestras redes</p>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/nutricampus.pt"
                        class="text-white text-2xl hover:text-yellow-400"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.instagram.com/nutricampusup?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                        class="text-white text-2xl hover:text-yellow-400"><i class="fab fa-instagram"></i></a>
                    <a href="https://acortar.link/3A8i6X" class="text-white text-2xl hover:text-yellow-400"><i
                            class="fab fa-tiktok"></i></a>
                </div>
            </div>

            <!-- Empresa -->
            <div>
                <h3 class="font-bold text-lg mb-4">Empresa</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('quienes-somos') }}" class="hover:text-yellow-400">¿Quiénes somos?</a></li>
                </ul>
            </div>

            <!-- Servicios -->
            <div>
                <h3 class="font-bold text-lg mb-4">Servicios</h3>
                <ul class="space-y-2">
                    <li><a href="#platillos" class="hover:text-yellow-400">Platillos del día</a></li>
                </ul>
            </div>

            <!-- Contacto -->
            <div>
                <h3 class="font-bold text-lg mb-4 ">Contáctanos</h3>
                <p class="mb-2">(01) 777-4343</p>
                <p class="mb-2">info@nutricampus.com</p>
            </div>

            <!-- Medios de pago -->
            <div>
                <h3 class="font-bold text-lg mb-4">Medios de Pago</h3>
                <div class="flex space-x-4">
                    <i class="fab fa-cc-mastercard text-4xl"></i>
                    <i class="fab fa-cc-visa text-4xl"></i>
                </div>
            </div>
        </div>
        <div class="mt-8 text-center border-t border-teal-600 pt-4">
            <span>&copy; 2024 Nutricampus. Todos los derechos reservados.</span>
        </div>
    </footer>

    <!-- JavaScript para el menú desplegable del usuario -->
    <script>
        document.getElementById('userMenuButton').addEventListener('click', function() {
            const userMenu = document.getElementById('userMenu');
            userMenu.classList.toggle('hidden');
        });

        // Cerrar el menú cuando se hace clic fuera de él
        document.addEventListener('click', function(event) {
            const userMenu = document.getElementById('userMenu');
            const button = document.getElementById('userMenuButton');

            if (!button.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
        });
    </script>

</body>

</html>