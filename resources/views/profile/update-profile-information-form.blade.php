<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Información del Perfil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Actualiza la información de tu cuenta y tu dirección de correo electrónico.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Foto de Perfil -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                <!-- Input para la Foto de Perfil -->
                <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                    x-on:change="  
                                    photoName = $refs.photo.files[0].name;  
                                    const reader = new FileReader();  
                                    reader.onload = (e) => {  
                                        photoPreview = e.target.result;  
                                    };  
                                    reader.readAsDataURL($refs.photo.files[0]);  
                            " />

                <x-label for="photo" value="{{ __('Foto') }}" class="font-bold text-gray-700" />

                <!-- Foto de Perfil Actual -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        class="rounded-full h-20 w-20 object-cover shadow-md">
                </div>

                <!-- Vista Previa de la Nueva Foto -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center shadow-md"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 me-2 bg-yellow-500 text-white hover:bg-yellow-600" type="button"
                    x-on:click.prevent="$refs.photo.click()">
                    {{ __('Seleccionar Nueva Foto') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2 bg-red-500 text-white hover:bg-red-600"
                        wire:click="deleteProfilePhoto">
                        {{ __('Eliminar Foto') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2 text-red-500" />
            </div>
        @endif

        <!-- Nombre -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Nombre') }}" class="font-bold text-gray-700" />
            <x-input id="name" type="text"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                wire:model="state.name" required autocomplete="name" />
            <x-input-error for="name" class="mt-2 text-red-500" />
        </div>

        <!-- Correo Electrónico -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Correo Electrónico') }}" class="font-bold text-gray-700" />
            <x-input id="email" type="email"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2 text-red-500" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                    !$this->user->hasVerifiedEmail())
                <p class="text-sm mt-2 text-gray-600">
                    {{ __('Tu dirección de correo electrónico no está verificada.') }}

                    <button type="button"
                        class="underline text-sm text-yellow-600 hover:text-yellow-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500"
                        wire:click.prevent="sendEmailVerification">
                        {{ __('Haz clic aquí para reenviar el correo de verificación.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('Se ha enviado un nuevo enlace de verificación a tu correo electrónico.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3 text-green-600" on="saved">
            {{ __('Guardado.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo" class="bg-yellow-500 hover:bg-yellow-600 text-white">
            {{ __('Guardar') }}
        </x-button>
    </x-slot>
</x-form-section>
