<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;

class CarritoController extends Controller
{
    // Método para agregar un producto al carrito
    public function agregar(Request $request)
    {
        $productoId = $request->input('id');
        $producto = Producto::findOrFail($productoId);

        // Obtener el carrito de la sesión, o inicializar un array si no existe
        $carrito = session()->get('carrito', []);

        // Si el producto ya está en el carrito, incrementa la cantidad
        if (isset($carrito[$productoId])) {
            $carrito[$productoId]['cantidad']++;
        } else {
            // Si no está en el carrito, añádelo con cantidad 1
            $carrito[$productoId] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => 1,
                'imagen' => $producto->imagen,
            ];
        }

        // Guardar el carrito en la sesión
        session()->put('carrito', $carrito);

        return redirect()->back()->with('message', 'Producto añadido al carrito.');
    }

    // Método para ver el contenido del carrito
    public function verCarrito()
    {
        $carrito = session()->get('carrito', []);
        $total = array_reduce($carrito, function ($carry, $item) {
            return $carry + ($item['precio'] * $item['cantidad']);
        }, 0);

        return view('carrito', compact('carrito', 'total'));
    }

    // Método para actualizar la cantidad de un producto en el carrito
    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1|max:20',
        ]);

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] = $request->input('cantidad');
            session()->put('carrito', $carrito);
        }

        $subtotal = $carrito[$id]['precio'] * $carrito[$id]['cantidad'];
        $total = array_reduce($carrito, function ($carry, $item) {
            return $carry + ($item['precio'] * $item['cantidad']);
        }, 0);

        return response()->json([
            'success' => true,
            'subtotal' => $subtotal,
            'total' => $total,
        ]);
    }

    // Método para eliminar un producto del carrito
    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        session()->flash('message', 'Producto eliminado del carrito.');

        return redirect()->route('carrito.ver');
    }

    // Método para realizar el pago, accesible solo para usuarios autenticados con rol de cliente
    public function realizarPago()
    {
        // Verificar que el usuario esté autenticado y tenga rol de cliente (id_rol=2)
        if (Auth::check() && Auth::user()->id_rol === 2) {
            // Aquí iría la lógica para procesar el pago
            return redirect()->route('home')->with('message', 'Pago realizado con éxito.');
        }

        // Redirigir a la vista de administración si el rol es de administrador (id_rol=1)
        if (Auth::check() && Auth::user()->id_rol === 1) {
            return redirect()->route('dashboard')->with('message', 'Acceso autorizado para administrador.');
        }

        // Redirigir al login si el usuario no está autenticado o no tiene el rol adecuado
        return redirect()->route('login')->with('error', 'Debes iniciar sesión como cliente para realizar el pago.');
    }
}
