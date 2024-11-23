<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('metodo_pago')->insert([
            ['tipo' => 'Mercado Pago', 'descripcion' => 'Pagos con cuenta mercado pago', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Tarjeta Crédito', 'descripcion' => 'Todas las tarjetas de credito', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Tarjeta Débito', 'descripcion' => 'Todas las taarjetas de debito', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Depósito Pago Efectivo', 'descripcion' => 'Pago en agente o tambo', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Transferencia Pago Efectivo', 'descripcion' => 'Pago APP banca movil', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Yape', 'descripcion' => 'Yape BCP', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 805e3361fbf3f8cf84d64439bb09f4c51965dc6d
