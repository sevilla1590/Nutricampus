<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('administrador')->insert([
            //'id_administrador' => 1, // ID del usuario administrador desde UsersSeeder
            'id' => 1, // Referencia al ID del usuario en la tabla users
            'nombre' => 'Admin',
            'apellido' => 'Admin',
            'horario' => 'mañana',
            'certificado' => 'superior',
            'corte_ventas' => 'diario',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
