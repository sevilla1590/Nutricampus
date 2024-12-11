<!DOCTYPE html>
<html lang="en" class="!scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutricampus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lily+Script+One&family=Alfa+Slab+One&family=Charm&family=Crimson+Text&family=Amatic+SC&family=Inter+Tight:wght@400;500;700&family=Fraunces:opsz,wght@9..144,400;9..144,700&family=Montserrat:wght@400;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <!-- Header -->
    <header class="bg-teal-700">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex flex-col lg:flex-row lg:items-center">
                <!-- Logo y Menú Hamburguesa -->
                <div class="flex justify-between items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0">
                        <img src="{{ asset('images/NutricampusLogo.png') }}" alt="Nutricampus Logo" class="h-16">
                    </a>
                    <button id="mobile-menu-button" class="lg:hidden text-white">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>

                <!-- Menú de navegación -->
                <div id="mobile-menu"
                    class="hidden lg:flex flex-col lg:flex-row lg:items-center lg:justify-between flex-grow mt-4 lg:mt-0">
                    <!-- Enlaces de navegación -->
                    <ul
                        class="flex flex-col lg:flex-row space-y-2 lg:space-y-0 lg:space-x-16 text-white font-bold uppercase lg:mx-auto">
                        <li><a href="#platillos" class="block hover:text-yellow-400 transition duration-300">Platos del
                                día</a></li>
                        <li><a href="{{ route('mis.pedidos') }}"
                                class="block hover:text-yellow-400 transition duration-300">Mis pedidos</a></li>
                        <li><a href="{{ route('contactanos') }}"
                                class="block hover:text-yellow-400 transition duration-300">Contáctanos</a></li>
                        <li><a href="#preguntas" class="block hover:text-yellow-400 transition duration-300">FAQ</a>
                        </li>
                    </ul>

                    <!-- Usuario y Carrito -->
                    <div
                        class="flex flex-col lg:flex-row items-center space-y-2 lg:space-y-0 lg:space-x-6 mt-4 lg:mt-0 lg:ml-8">
                        @auth
                            <div class="relative w-full lg:w-auto">
                                <button
                                    class="flex items-center justify-center w-full lg:w-auto bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300"
                                    id="userMenuButton">
                                    <i class="fas fa-user text-xl mr-2"></i>
                                    <span class="truncate">{{ Auth::user()->name }}</span>
                                    <i class="fas fa-chevron-down ml-2"></i>
                                </button>
                                <!-- Menú desplegable -->
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden z-50"
                                    id="userMenu">
                                    <a href="{{ route('profile.show') }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Preferencias</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                            Cerrar sesión
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="flex items-center text-white hover:text-yellow-400 transition duration-300">
                                <i class="fas fa-user text-2xl mr-2"></i>
                                <span>Iniciar sesión</span>
                            </a>
                        @endauth

                        <!-- Carrito -->
                        <div class="relative">
                            <a href="{{ route('carrito.ver') }}"
                                class="flex items-center text-white hover:text-yellow-400 transition duration-300">
                                <i class="fas fa-shopping-cart text-2xl mr-2"></i>
                                <span>Carrito</span>
                                @if (session('carrito') && count(session('carrito')) > 0)
                                    <span
                                        class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                        {{ count(session('carrito')) }}
                                    </span>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-teal-700 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
                <!-- Logo y redes sociales -->
                <div class="flex flex-col items-center md:items-start">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/NutricampusLogo.png') }}" alt="Nutricampus Logo" class="h-16 mb-4">
                    </a>
                    <p class="font-bold mb-4">Visita nuestras redes</p>
                    <div class="flex space-x-6">
                        <a href="https://www.facebook.com/nutricampus.pt"
                            class="text-white text-2xl hover:text-yellow-400 transition duration-300">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/nutricampusup"
                            class="text-white text-2xl hover:text-yellow-400 transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://acortar.link/3A8i6X"
                            class="text-white text-2xl hover:text-yellow-400 transition duration-300">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>

                <!-- Secciones del footer -->
                <div class="text-center md:text-left">
                    <h3 class="font-bold text-lg mb-4">Empresa</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('quienes-somos') }}"
                                class="hover:text-yellow-400 transition duration-300">¿Quiénes somos?</a></li>
                    </ul>
                </div>

                <div class="text-center md:text-left">
                    <h3 class="font-bold text-lg mb-4">Servicios</h3>
                    <ul class="space-y-2">
                        <li><a href="#platillos" class="hover:text-yellow-400 transition duration-300">Platillos del
                                día</a></li>
                    </ul>
                </div>

                <div class="text-center md:text-left">
                    <h3 class="font-bold text-lg mb-4">Contáctanos</h3>
                    <p class="mb-2">(01) 777-4343</p>
                    <p class="mb-2">info@nutricampus.com</p>
                </div>

                <div class="text-center md:text-left">
                    <h3 class="font-bold text-lg mb-4">Medios de Pago</h3>
                    <div class="flex justify-center md:justify-start space-x-4">
                        <i class="fab fa-cc-mastercard text-4xl"></i>
                        <i class="fab fa-cc-visa text-4xl"></i>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center border-t border-teal-600 pt-4">
                <span>&copy; 2024 Nutricampus. Todos los derechos reservados.</span>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Menú móvil  
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // Menú usuario  
        document.getElementById('userMenuButton')?.addEventListener('click', function(e) {
            e.stopPropagation();
            document.getElementById('userMenu').classList.toggle('hidden');
        });

        // Cerrar menú usuario al hacer clic fuera  
        document.addEventListener('click', function(e) {
            const userMenu = document.getElementById('userMenu');
            const userMenuButton = document.getElementById('userMenuButton');

            if (userMenu && !userMenuButton?.contains(e.target) && !userMenu.contains(e.target)) {
                userMenu.classList.add('hidden');
            }
        });

        // Cerrar menú móvil en pantallas grandes  
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                document.getElementById('mobile-menu').classList.remove('hidden');
            } else {
                document.getElementById('mobile-menu').classList.add('hidden');
            }
        });
    </script>
</body>

</html>
