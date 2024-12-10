<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['nombre_rol' => 'Admin', 'descripcion' => 'Administrador del sistema', 'permisos' => 'General', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_rol' => 'Cliente', 'descripcion' => 'Usuario cliente', 'permisos' => 'Cliente', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_rol' => 'Cocinero', 'descripcion' => 'Usuario cocinero', 'permisos' => 'Cocina', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_rol' => 'Repartidor', 'descripcion' => 'Usuario repartidor', 'permisos' => 'Reparto', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('rol')->insert($roles);
    }
}
