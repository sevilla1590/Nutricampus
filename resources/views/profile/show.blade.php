@extends('layouts.layout')

@section('content')
    <div class="bg-customBeige">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Preferencias') }}
                </h2>
            </x-slot>

            <div class="bg-customBeige">
                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Actualizar Información de Perfil</h3>
                            @livewire('profile.update-profile-information-form')
                        </div>

                        <x-section-border />
                    @endif

                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                        <div class="mt-10 sm:mt-0 bg-white shadow-md rounded-lg p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Actualizar Contraseña</h3>
                            @livewire('profile.update-password-form')
                        </div>

                        <x-section-border />
                    @endif

                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                        <div class="mt-10 sm:mt-0 bg-white shadow-md rounded-lg p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Autenticación en Dos Factores</h3>
                            @livewire('profile.two-factor-authentication-form')
                        </div>

                        <x-section-border />
                    @endif

                    <div class="mt-10 sm:mt-0 bg-white shadow-md rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Cerrar Sesión en Otros Navegadores</h3>
                        @livewire('profile.logout-other-browser-sessions-form')
                    </div>

                    {{-- @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                        <x-section-border />

                        <div class="mt-10 sm:mt-0 bg-white shadow-md rounded-lg p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Eliminar Cuenta</h3>
                            @livewire('profile.delete-user-form')
                        </div>
                    @endif --}}
                </div>
            </div>

        </div>
    </div>
@endsection
