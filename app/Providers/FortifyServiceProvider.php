<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;  // Importa la clase User

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // Vista personalizada de login
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // Evento posterior al login
        Event::listen(\Illuminate\Auth\Events\Login::class, function ($event) {
            $user = $event->user;

            // Fusionar el carrito de sesión con el del usuario
            $this->mergeCarritoSesion();

            if ($user->id_rol == 2) { // Cliente
                return redirect()->route('carrito.ver');
            }

            return redirect()->route('dashboard'); // Otro rol
        });

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        Fortify::authenticateUsing(function ($request) {
            $user = \App\Models\User::with('cliente')->where('email', $request->email)->first();

            // Verifica si el usuario existe y si la contraseña es correcta
            if ($user && Hash::check($request->password, $user->password)) {
                // Si el usuario tiene un cliente asociado, verifica que esté 'activo'
                if ($user->cliente) {
                    if ($user->cliente->estado !== 'activo') {
                        // Lanza una excepción para cuentas inactivas
                        throw ValidationException::withMessages([
                            Fortify::username() => 'Tu cuenta fue inactivada, comunícate con admin@nutricampus.com',
                        ]);
                    }

                    return $user; // Autentica a clientes activos
                } else {
                    // Si no tiene cliente asociado (por ejemplo, es un administrador), permite el acceso
                    return $user;
                }
            }

            // Si no cumple las condiciones, devuelve un mensaje estándar
            throw ValidationException::withMessages([
                Fortify::username() => trans('auth.failed'),
            ]);
        });
    }

    protected function mergeCarritoSesion(): void
    {
        $carritoSesion = session()->get('carrito', []);

        if (Auth::check()) {
            $carritoUsuario = []; // Si guardas el carrito en la base de datos para usuarios registrados
            // Combinar los carritos (priorizando los datos del carrito de sesión)
            foreach ($carritoSesion as $id => $item) {
                if (isset($carritoUsuario[$id])) {
                    $carritoUsuario[$id]['cantidad'] += $item['cantidad'];
                } else {
                    $carritoUsuario[$id] = $item;
                }
            }
            // Actualizar el carrito del usuario registrado
            session()->put('carrito', $carritoUsuario);
        }
    }
}
