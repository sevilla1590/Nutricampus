<x-action-section>
    <x-slot name="title">
        {{ __('Autenticación en Dos Factores') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Agrega seguridad adicional a tu cuenta utilizando la autenticación en dos factores.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('Finaliza la activación de la autenticación en dos factores.') }}
                @else
                    {{ __('Has activado la autenticación en dos factores.') }}
                @endif
            @else
                {{ __('No has activado la autenticación en dos factores.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('Cuando la autenticación en dos factores está activada, se te pedirá un token seguro y aleatorio durante la autenticación. Puedes obtener este token desde la aplicación Google Authenticator de tu teléfono.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            {{ __('Para finalizar la activación de la autenticación en dos factores, escanea el siguiente código QR con la aplicación de autenticación de tu teléfono o ingresa la clave de configuración y proporciona el código OTP generado.') }}
                        @else
                            {{ __('La autenticación en dos factores está activada. Escanea el siguiente código QR con la aplicación de autenticación de tu teléfono o ingresa la clave de configuración.') }}
                        @endif
                    </p>
                </div>

                <div class="mt-4 p-2 inline-block bg-white">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Clave de Configuración') }}: {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-label for="code" value="{{ __('Código') }}" class="font-bold text-gray-700" />

                        <x-input id="code" type="text" name="code"
                            class="block mt-1 w-1/2 border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                            inputmode="numeric" autofocus autocomplete="one-time-code" wire:model="code"
                            wire:keydown.enter="confirmTwoFactorAuthentication" />

                        <x-input-error for="code" class="mt-2 text-red-500" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Guarda estos códigos de recuperación en un administrador de contraseñas seguro. Estos códigos pueden ser utilizados para recuperar el acceso a tu cuenta si pierdes tu dispositivo de autenticación en dos factores.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (!$this->enabled)
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-button type="button" wire:loading.attr="disabled"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white">
                        {{ __('Activar') }}
                    </x-button>
                </x-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-secondary-button class="me-3 bg-blue-500 hover:bg-blue-600 text-white">
                            {{ __('Regenerar Códigos de Recuperación') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @elseif ($showingConfirmation)
                    <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-button type="button" class="me-3 bg-green-500 hover:bg-green-600 text-white"
                            wire:loading.attr="disabled">
                            {{ __('Confirmar') }}
                        </x-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="showRecoveryCodes">
                        <x-secondary-button class="me-3 bg-blue-500 hover:bg-blue-600 text-white">
                            {{ __('Mostrar Códigos de Recuperación') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-secondary-button wire:loading.attr="disabled" class="bg-red-500 hover:bg-red-600 text-white">
                            {{ __('Cancelar') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-danger-button wire:loading.attr="disabled" class="bg-red-500 hover:bg-red-600 text-white">
                            {{ __('Desactivar') }}
                        </x-danger-button>
                    </x-confirms-password>
                @endif
            @endif
        </div>
    </x-slot>
</x-action-section>
