<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto'; // Especifica el nombre de la tabla

    protected $fillable = ['nombre', 'precio', 'descripcion', 'disponibilidad'];

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'id_producto');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_producto');
    }
}
