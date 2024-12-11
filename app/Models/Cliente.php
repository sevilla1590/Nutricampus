<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    const ESTADO_ACTIVO = 'activo';

    const ESTADO_INACTIVO = 'inactivo';

    const ESTADO_PROMOVIDO = 'promovido';

    protected $table = 'cliente'; // Especifica el nombre de la tabla

    protected $primaryKey = 'id_cliente'; // Llave primaria

    protected $fillable = [
        'id', // Llave foránea hacia la tabla users
        'nombre',
        'apellido',
        'direccion',
        'preferencias',
        'observaciones',
        'estado',
    ];

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
