<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    // Especifica el nombre correcto de la tabla
    protected $table = 'pedido'; 

    protected $fillable = [
        'id_metodo_pago',
        'id_cliente',
        'id_administrador',
        'id_repartidor',
        'id_cocinero',
        'fecha',
        'total',
        'estado_pago',
        'estado',
        'nro_transaccion',
    ];

    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class, 'id_metodo_pago');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'id_administrador');
    }

    public function repartidor()
    {
        return $this->belongsTo(Repartidor::class, 'id_repartidor');
    }

    public function cocinero()
    {
        return $this->belongsTo(Cocinero::class, 'id_cocinero');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido');
    }
}
