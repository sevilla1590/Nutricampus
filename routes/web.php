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
use App\Http\Controllers\ResumenPedidoController;
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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Resumen de pedido
    Route::get('/resumen-pedido', [ResumenPedidoController::class, 'mostrarResumen'])->name('resumen.pedido');
    Route::get('/pago-exitoso', [ResumenPedidoController::class, 'pagoExitoso'])->name('pago.exitoso');
    Route::get('/pago-fallido', [ResumenPedidoController::class, 'pagoFallido'])->name('pago.fallido');
    Route::get('/pago-pendiente', [ResumenPedidoController::class, 'pagoPendiente'])->name('pago.pendiente');
});

//Erek 16 nov madrugada
//Ruta de "Cambiar Estado de Pedido"
Route::get('/pedidos/listar', [PedidoController::class, 'listarPedidos'])->name('pedidos.listar');
//Route::put('/pedidos/{pedido}', [PedidoController::class, 'update'])->name('pedido.update');

//Ruta de "Gestionar reembolsos"
Route::get('/reembolsos', [ReembolsoController::class, 'index'])->name('reembolsos.index'); // Ver lista de reembolsos
//Route::get('/reembolsos/{reembolso}/editar', [ReembolsoController::class, 'edit'])->name('reembolsos.edit');

//Regresar a dashboard
Route::get('/admin/dashboard', function () {return view('admindashboard');})->name('admin.dashboard');
//Erek 16 nov madrugada

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
            return redirect()->route('index'); // Redirigir a home si no es admin
        }
        return redirect()->route('login'); // Si el usuario no está autenticado
    })->name('dashboard'); // Nombrar correctamente como "dashboard"
    
    // Rutas CRUD protegidas por el Middleware de autenticación
    Route::resource('users', UserController::class);
    Route::resource('administradores', AdministradorController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('cocineros', CocineroController::class);
    Route::resource('detalle-pedidos', DetallePedidoController::class);
//    Route::resource('pedidos', PedidoController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('reembolsos', ReembolsoController::class);
    Route::resource('repartidores', RepartidorController::class);
    Route::resource('teams', TeamController::class);
});

// Proteger las vistas de pedidos para administradores
Route::middleware(['auth'])->group(function () {
    // Lista de pedidos (index.blade.php)
    Route::get('/pedidos/listar', function (Illuminate\Http\Request $request) {
        if (Auth::check() && Auth::user()->id_rol === 1) { // Solo administradores
            return app(\App\Http\Controllers\PedidoController::class)->listarPedidos($request);
        }
        return redirect()->route('home')->with('error', 'Acceso denegado.');
    })->name('pedidos.listar');

    // Editar pedido (edit.blade.php)
    Route::get('/pedidos/{pedido}/edit', function ($pedido) {
        if (Auth::check() && Auth::user()->id_rol === 1) { // Solo administradores
            $pedidoModel = \App\Models\Pedido::findOrFail($pedido);
            return app(\App\Http\Controllers\PedidoController::class)->edit($pedidoModel);
        }
        return redirect()->route('home')->with('error', 'Acceso denegado.');
    })->name('pedido.edit');

    // Ver detalle del pedido (show.blade.php)
    Route::get('/pedidos/{pedido}', function ($pedido) {
        if (Auth::check() && Auth::user()->id_rol === 1) { // Solo administradores
            $pedidoModel = \App\Models\Pedido::findOrFail($pedido);
            return app(\App\Http\Controllers\PedidoController::class)->show($pedidoModel);
        }
        return redirect()->route('home')->with('error', 'Acceso denegado.');
    })->name('pedido.show');

    // Actualizar pedido (desde edit.blade.php)
    Route::put('/pedidos/{pedido}', function ($pedido) {
        if (Auth::check() && Auth::user()->id_rol === 1) { // Solo administradores
            $pedidoModel = \App\Models\Pedido::findOrFail($pedido);
            return app(\App\Http\Controllers\PedidoController::class)->update(request(), $pedidoModel);
        }
        return redirect()->route('home')->with('error', 'Acceso denegado.');
    })->name('pedido.update');
});


// Proteger las vistas de reembolsos para administradores
Route::middleware(['auth'])->group(function () {
    // Lista de reembolsos (index.blade.php)
    Route::get('/reembolsos', function () {
        if (Auth::check() && Auth::user()->id_rol === 1) { // Verifica si el usuario está autenticado y es administrador
            return app(\App\Http\Controllers\ReembolsoController::class)->index();
        }
        return redirect()->route('dashboard')->with('error', 'Acceso denegado.');
    })->name('reembolsos.index');

    // Editar reembolso (edit.blade.php)
    Route::get('/reembolsos/{reembolso}/editar', function (\App\Models\Reembolso $reembolso) {
        if (Auth::check() && Auth::user()->id_rol === 1) { // Verifica si el usuario está autenticado y es administrador
            return app(\App\Http\Controllers\ReembolsoController::class)->edit($reembolso);
        }
        return redirect()->route('dashboard')->with('error', 'Acceso denegado.');
    })->name('reembolsos.edit');

    // Actualizar reembolso (desde edit.blade.php)
    Route::put('/reembolsos/{reembolso}', function (\Illuminate\Http\Request $request, \App\Models\Reembolso $reembolso) {
        if (Auth::check() && Auth::user()->id_rol === 1) { // Verifica si el usuario está autenticado y es administrador
            return app(\App\Http\Controllers\ReembolsoController::class)->update($request, $reembolso);
        }
        return redirect()->route('dashboard')->with('error', 'Acceso denegado.');
    })->name('reembolsos.update');
});

//Rutas de vista de mis pedidos

Route::middleware(['auth'])->group(function () {
    Route::get('/mis-pedidos', [PedidoController::class, 'misPedidos'])->name('mis.pedidos');
});

Route::get('/pedido/{id}/estado', [PedidoController::class, 'verEstado'])->name('pedido.estado');

// Rutas para gestionar, agregar y seleccionar menu

Route::get('/menu/gestionar', [ProductoController::class, 'gestionarMenu'])->name('productos.gestionarMenu');
Route::post('/menu/actualizar-carta', [ProductoController::class, 'actualizarCarta'])->name('productos.actualizarCarta');
Route::post('/menu/crear-producto', [ProductoController::class, 'crearProducto'])->name('productos.crearProducto');

// Ruta para ver el menu ya procesado por administrador

Route::get('/index', [ProductoController::class, 'index'])->name('index');
Route::get('/', [ProductoController::class, 'index'])->name('index');
