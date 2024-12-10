@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">
            {{ __('Whoops! Algo salió mal.') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                @if ($error === 'These credentials do not match our records.')
                    <li>Usuario o contraseña incorrectos. Por favor, inténtalo de nuevo.</li>
                @else
                    <li>{{ $error }}</li>
                @endif
            @endforeach
        </ul>
    </div>
@endif
