<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Actualizar Contraseña') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Asegúrate de que tu cuenta esté utilizando una contraseña larga y segura para mantenerla protegida.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Contraseña Actual -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('Contraseña Actual') }}" class="font-bold text-gray-700" />
            <x-input id="current_password" type="password"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                wire:model="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2 text-red-500" />
        </div>

        <!-- Nueva Contraseña -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('Nueva Contraseña') }}" class="font-bold text-gray-700" />
            <x-input id="password" type="password"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                wire:model="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2 text-red-500" />
        </div>

        <!-- Confirmar Contraseña -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}"
                class="font-bold text-gray-700" />
            <x-input id="password_confirmation" type="password"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2 text-red-500" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3 text-green-600" on="saved">
            {{ __('Guardado.') }}
        </x-action-message>

        <x-button class="bg-yellow-500 hover:bg-yellow-600 text-white">
            {{ __('Guardar') }}
        </x-button>
    </x-slot>
</x-form-section>
