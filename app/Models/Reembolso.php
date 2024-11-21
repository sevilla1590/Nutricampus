<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reembolso extends Model
{
    use HasFactory;

    protected $table = 'reembolso'; // Nombre correcto de la tabla

    protected $primaryKey = 'id_reembolso'; // Clave primaria de la tabla
    public $incrementing = true; // Especifica que la clave es autoincremental
    protected $keyType = 'int'; // Tipo de dato de la clave primaria

    protected $fillable = [
        'id_cliente',
        'id_pedido',
        'fecha_reembolso',
        'monto',
        'motivo',
        'estado',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function edit(Reembolso $reembolso)
    {
        return view('reembolso.edit', compact('reembolso'));
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id');
    }

    public function reembolsos()
    {
        return $this->hasMany(Reembolso::class, 'id_producto');
    }
}
