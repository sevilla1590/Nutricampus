<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RepartidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('repartidor')->insert([
            //'id_repartidor' => 1, // ID del usuario repartidor desde UsersSeeder
            'id' => 11, // Referencia al ID del usuario en la tabla users
            'nombre' => 'Repartidor',
            'apellido' => 'Repartidor',
            'horario' => 'mañana',
            'placa_vehiculo' => 'bbz-490',
            'numero_licencia' => '888888',
            'certificado' => 'trabajo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
