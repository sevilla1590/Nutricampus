<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    // Especificar el nombre correcto de la tabla
    protected $table = 'detalle_pedido'; // Cambia esto al nombre real de la tabla

    protected $fillable = [
        'id_pedido',
        'id_producto',
        'precio_unitario',
        'cantidad',
        'subtotal',
        
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
