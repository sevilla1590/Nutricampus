<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'direccion', 'preferencias', 'observaciones'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_cliente');
    }

    public function reembolsos()
    {
        return $this->hasMany(Reembolso::class, 'id_cliente');
    }
}
