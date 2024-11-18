<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ResumenPedidoController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

// Middleware principal del grupo web
Route::middleware('web')->group(function () {
    // Página principal
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/producto/{id}', [HomeController::class, 'detalleProducto'])->name('producto.detalle');

    // Carrito (rutas accesibles sin autenticación)
    Route::get('/carrito', [CarritoController::class, 'verCarrito'])->name('carrito.ver');
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::put('/carrito/actualizar/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');

    // Rutas protegidas para el resumen del pedido y pagos
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        // Resumen de pedido
        Route::get('/resumen-pedido', [ResumenPedidoController::class, 'mostrarResumen'])->name('resumen.pedido');
        Route::get('/pago-exitoso', [ResumenPedidoController::class, 'pagoExitoso'])->name('pago.exitoso');
        Route::get('/pago-fallido', [ResumenPedidoController::class, 'pagoFallido'])->name('pago.fallido');
        Route::get('/pago-pendiente', [ResumenPedidoController::class, 'pagoPendiente'])->name('pago.pendiente');
    });

    // Rutas protegidas para roles y autenticación en el dashboard
    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
        Route::get('/dashboard', function () {
            if (Auth::check()) {
                $user = Auth::user();
                if ($user->id_rol === 1) { // Si es administrador
                    return view('admindashboard');
                }
                return redirect()->route('home'); // Redirigir a home si no es administrador
            }
            return redirect()->route('login'); // Redirigir al login si no está autenticado
        })->name('dashboard');
    });

    // Ruta adicional para login personalizado
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
});
