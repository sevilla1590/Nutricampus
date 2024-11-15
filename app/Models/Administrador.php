<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'horario', 'certificado', 'corte_ventas'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
