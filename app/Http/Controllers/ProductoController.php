<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::where('carta', 1)->get();
        return view('index', compact('productos'));
    }

    public function create()
    {
        return view('producto.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|string|max:100',
            'disponibilidad' => 'required|integer',
        ]);

        Producto::create($data);

        return redirect()->route('producto.index')->with('success', 'Producto created successfully');
    }

    public function show(Producto $producto)
    {
        return view('producto.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        return view('producto.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|string|max:100',
            'disponibilidad' => 'required|integer',
        ]);

        $producto->update($data);

        return redirect()->route('producto.index')->with('success', 'Producto updated successfully');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('producto.index')->with('success', 'Producto deleted successfully');
    }

    //Erik: Gestionar menú
    public function gestionarMenu()
    {
        $productos = Producto::all(); // Todos los productos
        $menu = Producto::where('carta', true)->get(); // Productos seleccionados para el menú

        return view('menu.gestionar-menu', compact('productos', 'menu')); // Cambiar el nombre de la vista aquí
    }

    public function actualizarCarta(Request $request)
    {
        // Validar que máximo 4 productos pueden estar en la carta
        $productosSeleccionados = $request->productos ?? [];
        if (count($productosSeleccionados) > 4) {
            return redirect()->back()->with('error', 'Solo puedes seleccionar hasta 4 productos para la carta.');
        }

        // Desmarcar todos los productos de la carta
        Producto::query()->update(['carta' => false]);

        // Marcar los productos seleccionados como destacados en la carta
        Producto::whereIn('id', $productosSeleccionados)->update(['carta' => true]);

        return redirect()->route('productos.gestionarMenu')->with('success', 'La carta fue actualizada correctamente.');
    }

    public function crearProducto(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'beneficios' => 'nullable|string',
            'disponibilidad' => 'required|integer|min:0',
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.gestionarMenu')->with('success', 'Producto creado correctamente.');
    }

    public function mostrarFormularioEdicion($id)
    {
        $producto = Producto::findOrFail($id); // Busca el producto o lanza un error 404 si no existe
        return view('productos.formulario', compact('producto'));
    }

//Editar productos
    public function gestionar()
    {
        // Obtener todos los productos de la base de datos
        $producto = Producto::all();

        // Retornar la vista con los productos
        return view('menu.lista', compact('producto'));
    }

// Método para editar un producto

    public function gestionarPlatillos()
    {
        // Obtener todos los platillos disponibles
        $productos= Producto::all();

        // Retornar la vista lista de platillos
        return view('menu.lista', compact('productos'));
    }

    // Método para editar un platillo específico
    public function editarPlatillo($id)
    {
        // Obtener el platillo por su ID
        $producto = Producto::findOrFail($id);

        // Retornar la vista de edición con los datos del platillo
        return view('menu.editar', compact('producto'));
    }

    // Método para actualizar un platillo
    public function actualizarPlatillo(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'disponibilidad' => 'required|integer',
        ]);

        // Obtener el platillo a actualizar
        $producto = Producto::findOrFail($id);

        // Actualizar los datos del platillo
        $producto->update($request->all());

        // Redirigir de vuelta a la lista de platillos con un mensaje de éxito
        return redirect()->route('productos.gestionarPlatillos')->with('success', 'Platillo actualizado correctamente.');
    }

}
