<!-- resources/views/layouts/admin.blade.php -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <!-- Aquí puedes incluir tus archivos de CSS, puedes usar Bootstrap o Tailwind -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css">
    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">

</head>

<body class="bg-gray-100">

    <header class="bg-teal-700 flex items-center justify-between py-4 px-6">
        <!-- Logo o contenido a la izquierda -->
        <div class="flex items-center">
            <!-- Aquí iría el logo o cualquier otro elemento a la izquierda -->
        </div>
    
        <!-- Botón de inicio sesión o menú de usuario -->
        <div class="flex items-center space-x-6 ml-auto">
            @auth
                <div class="relative">
                    <!-- Menú de usuario -->
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
                <a href="{{ route('login') }}" class="text-white flex flex-col items-center hover:text-yellow-400">
                    <i class="fas fa-user text-2xl"></i>
                    <span class="text-sm hover:text-yellow-400">Iniciar sesión</span>
                </a>
            @endauth
        </div>
    </header>


    <!-- Barra Lateral -->
    <aside class="w-64 bg-gray-800 text-white min-h-screen fixed top-0 left-0 z-20 pt-16">
        <div class="px-4 py-6">
            <!-- Logo en la barra lateral -->
            <div class="flex justify-center mb-6">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/NutricampusLogo.png') }}" alt="Nutricampus Logo" class="h-16">
                </a>
            </div>
            <h2 class="text-2xl font-bold text-center mb-10">Admin Panel</h2>
            <nav>
                <ul>
                    <li>
                        <a href="{{ route('platillo.index') }}" class="block py-2 px-4 hover:bg-gray-700">Gestión de
                            Platillos</a>
                    </li>
                    <li>
                        <a href="{{ route('reembolsos.index') }}" class="block py-2 px-4 hover:bg-gray-700">Gestionar
                            Reembolsos</a>
                    </li>
                    <li>
                        <a href="{{ route('pedidos.listar') }}" class="block py-2 px-4 hover:bg-gray-700">Gestión de
                            Pedidos</a>
                    </li>
                    <li>
                        <a href="{{ route('reembolsos.index') }}" class="block py-2 px-4 hover:bg-gray-700">Gestión de
                            Usuarios</a>
                    </li>
                    <li>
                        <a href="{{ route('productos.gestionarMenu') }}" class="block py-2 px-4 hover:bg-gray-700">Activación de Menú</a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Contenido Principal -->
    <main class="ml-64 pt-24 p-6">
        @yield('content')
    </main>

</body>
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

</html>