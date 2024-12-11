<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Producto;

class ReporteController extends Controller
{
    public function index()
    {
        // 1. Ventas totales
        $ventasTotales = Pedido::sum('total');

        // 2. Cliente que más compró
        $clienteMasComprador = Pedido::selectRaw('id_cliente, SUM(total) as total_compras')
            ->groupBy('id_cliente')
            ->orderByDesc('total_compras')
            ->with('cliente') // Asegúrate de que la relación 'cliente' esté definida en el modelo Pedido
            ->first();

        // Si existe el cliente, añadimos sus detalles, si no, colocamos valores predeterminados
        $clienteMasCompradorInfo = $clienteMasComprador ? [
            'id_cliente' => $clienteMasComprador->id_cliente,
            'nombre' => $clienteMasComprador->cliente->nombre ?? 'Desconocido',
            'total_compras' => $clienteMasComprador->total_compras,
        ] : null;

        // 3. Número total de clientes activos
        $clientesActivos = Cliente::where('estado', 'activo')->count();

        // 4. Ranking de productos más comprados
        $productosMasComprados = DetallePedido::selectRaw('id_producto, COUNT(id_producto) as cantidad')
            ->groupBy('id_producto')
            ->orderByDesc('cantidad')
            ->with('producto') // Asegúrate de que la relación 'producto' esté definida en DetallePedido
            ->take(5)
            ->get()
            ->map(function ($detalle) {
                return [
                    'id_producto' => $detalle->id_producto,
                    'nombre' => $detalle->producto->nombre ?? 'Desconocido',
                    'cantidad' => $detalle->cantidad,
                ];
            });

        // Pasar los datos a la vista
        return view('reportes.index', compact(
            'ventasTotales',
            'clienteMasCompradorInfo',
            'clientesActivos',
            'productosMasComprados'
        ));
    }
}
