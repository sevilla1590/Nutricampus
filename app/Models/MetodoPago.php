<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    use HasFactory;

    protected $fillable = ['tipo', 'descripcion'];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_metodo_pago');
    }
}
