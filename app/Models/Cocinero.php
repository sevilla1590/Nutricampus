<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cocinero extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'especialidad'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_cocinero');
    }
}
