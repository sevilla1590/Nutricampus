<?php

namespace App\Http\Controllers;

use App\Models\Producto; // Importa el modelo Producto

class HomeController extends Controller
{
    public function index()
    {
        // Obtén todos los productos de la base de datos
        $productos = Producto::all();

        // Retorna la vista 'index' y pasa la variable $productos
        return view('index', compact('productos'));
    }

    public function detalleProducto($id)
    {
        $producto = Producto::findOrFail($id);

        return view('detallepedido', compact('producto'));
    }
}
