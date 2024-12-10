<x-action-section>
    <x-slot name="title">
        {{ __('Eliminar Cuenta') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Elimina tu cuenta de forma permanente.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados de forma permanente. Antes de eliminar tu cuenta, por favor descarga cualquier dato o información que desees conservar.') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled"
                class="bg-yellow-500 hover:bg-yellow-600 text-white">
                {{ __('Eliminar Cuenta') }}
            </x-danger-button>
        </div>

        <!-- Modal de Confirmación para Eliminar Cuenta -->
        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Eliminar Cuenta') }}
            </x-slot>

            <x-slot name="content">
                {{ __('¿Estás seguro de que deseas eliminar tu cuenta? Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados de forma permanente. Por favor, ingresa tu contraseña para confirmar que deseas eliminar tu cuenta de forma permanente.') }}

                <div class="mt-4" x-data="{}"
                    x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password"
                        class="mt-1 block w-3/4 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500"
                        autocomplete="current-password" placeholder="{{ __('Contraseña') }}" x-ref="password"
                        wire:model="password" wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2 text-red-500" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled"
                    class="bg-gray-500 hover:bg-gray-600 text-white">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3 bg-red-500 hover:bg-red-600 text-white" wire:click="deleteUser"
                    wire:loading.attr="disabled">
                    {{ __('Eliminar Cuenta') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
