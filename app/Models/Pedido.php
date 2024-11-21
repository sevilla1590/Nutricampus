<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    // Especifica el nombre correcto de la tabla
    protected $table = 'pedido'; 

    // Si tienes una clave primaria personalizada, defínela
    protected $primaryKey = 'id'; 

    protected $fillable = ['id_cliente', 'fecha', 'total', 'estado']; // Campos asignables

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
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

}
