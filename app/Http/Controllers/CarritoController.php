<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CarritoController extends Controller
{
    public function agregar(Request $request)
    {
        $productoId = $request->input('id');
        $producto = Producto::findOrFail($productoId);

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$productoId])) {
            $carrito[$productoId]['cantidad']++;
        } else {
            $carrito[$productoId] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => 1,
                'imagen' => $producto->imagen,
            ];
        }

        session()->put('carrito', $carrito);

        return redirect()->back()->with('message', 'Producto añadido al carrito.');
    }

    public function verCarrito()
    {
        $carrito = session()->get('carrito', []);
        $total = array_reduce($carrito, function ($carry, $item) {
            return $carry + ($item['precio'] * $item['cantidad']);
        }, 0);

        return view('carrito', compact('carrito', 'total'));
    }

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
        'carrito' => $carrito, // Devolvemos el carrito actualizado al cliente
    ]);
}

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
}
