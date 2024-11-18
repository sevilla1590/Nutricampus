<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HandleCarrito
{
    /**
     * Manejar el carrito entre sesiones y usuarios autenticados.
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Obtener carrito de la sesión
            $carritoSesion = session()->get('carrito', []);

            // Aquí podrías recuperar el carrito del usuario autenticado desde la base de datos
            $carritoUsuario = []; // Ejemplo: carrito guardado en base de datos

            // Fusionar carritos (prioriza los de la sesión)
            foreach ($carritoSesion as $id => $item) {
                if (isset($carritoUsuario[$id])) {
                    $carritoUsuario[$id]['cantidad'] += $item['cantidad'];
                } else {
                    $carritoUsuario[$id] = $item;
                }
            }

            // Guardar el carrito combinado en la sesión
            session()->put('carrito', $carritoUsuario);
        }

        return $next($request);
    }
}
