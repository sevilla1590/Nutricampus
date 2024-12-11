<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificarEstadoCliente
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
    
        // Verificar si el cliente está inactivo pero excluir a los promovidos
        if ($user && $user->cliente && $user->cliente->estado === 'inactivo') {
            auth()->logout(); // Cerrar sesión del usuario
    
            return redirect()->route('login')->withErrors(['status' => 'Tu cuenta está inactiva. Contacta al administrador.']);
        }
    
        return $next($request);
    }
    
    
    
}
