<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CocineroController;
use App\Http\Controllers\DetallePedidoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReembolsoController;
use App\Http\Controllers\RepartidorController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarritoController;

// Rutas accesibles sin autenticación
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/index', [HomeController::class, 'index'])->name('index');
Route::get('/producto/{id}', [HomeController::class, 'detalleProducto'])->name('producto.detalle');

// Rutas del carrito sin autenticación
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::get('/carrito', [CarritoController::class, 'verCarrito'])->name('carrito.ver');
Route::put('/carrito/actualizar/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');

// Ruta de "Realizar Pago" protegida, que requiere autenticación y rol de cliente
Route::get('/carrito/realizarPago', [CarritoController::class, 'realizarPago'])->name('carrito.realizarPago')->middleware(['auth:sanctum', 'verified']);

// Middleware para verificar autenticación y rol
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    // Ruta de Dashboard que redirige según el rol
    Route::get('/dashboard', function () {
        if (Auth::check()) {
            $user = Auth::user();
            // Asegurarse de que el usuario tenga un rol asignado antes de la validación
            if ($user->id_rol === 1) { // Ejemplo: id_rol 1 para administrador
                return view('admindashboard'); // Vista específica para administradores
            }
            return redirect()->route('home'); // Redirigir a home si no es admin
        }
        return redirect()->route('login'); // Si el usuario no está autenticado
    })->name('dashboard'); // Nombrar correctamente como "dashboard"
    
    // Rutas CRUD protegidas por el Middleware de autenticación
    Route::resource('users', UserController::class);
    Route::resource('administradores', AdministradorController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('cocineros', CocineroController::class);
    Route::resource('detalle-pedidos', DetallePedidoController::class);
    Route::resource('pedidos', PedidoController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('reembolsos', ReembolsoController::class);
    Route::resource('repartidores', RepartidorController::class);
    Route::resource('teams', TeamController::class);
});
