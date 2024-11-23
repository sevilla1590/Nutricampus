<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@nutricampus.com',
                'id_rol' => 1, // Rol de administrador
                'password' => Hash::make('nutricampus'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Generar 9 usuarios con rol de cliente
        for ($i = 1; $i <= 9; $i++) {
            $users[] = [
                'name' => 'Cliente ' . $i,
                'email' => 'cliente' . $i . '@nutricampus.com',
                'id_rol' => 2, // Rol de cliente
                'password' => Hash::make('nutricampus'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Agregar un usuario con rol de repartidor
        $users[] = [
            'name' => 'Repartidor',
            'email' => 'repartidor@nutricampus.com',
            'id_rol' => 3, // Rol de repartidor
            'password' => Hash::make('nutricampus'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Agregar un usuario con rol de cocinero
        $users[] = [
            'name' => 'Cocinero',
            'email' => 'cocinero@nutricampus.com',
            'id_rol' => 4, // Rol de cocinero
            'password' => Hash::make('nutricampus'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Insertar los usuarios en la tabla
        DB::table('users')->insert($users);
    }
}
