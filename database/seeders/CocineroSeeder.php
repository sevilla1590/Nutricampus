<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CocineroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cocinero')->insert([
            //'id_cocinero' => 1, // ID del usuario cocinero desde UsersSeeder
            'id' => 12, // Referencia al ID del usuario en la tabla users (suponiendo que es el último creado)
            'nombre' => 'Cocinero',
            'apellido' => 'Cocinero',
            'especialidad' => 'comida saludable',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
