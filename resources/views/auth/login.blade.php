<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center"
        style="background-image: url('{{ asset('images/fondologin.jpg') }}');">
        <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Inicio de Sesión</h2>

            <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <x-label for="email" value="E-mail:" class="font-semibold" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="username" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-label for="password" value="Contraseña:" class="font-semibold" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center text-sm text-gray-700">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ml-2">Recordarme</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center mt-4">
                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded">
                        ENTRAR
                    </button>
                </div>
            </form>

            <!-- Register Link -->
            <p class="mt-4 text-sm text-center text-gray-600">
                ¿No tienes una cuenta?
                <a href="{{ route('register') }}" class="text-red-500 hover:underline">Regístrate</a>
            </p>
        </div>
    </div>
</x-guest-layout>
