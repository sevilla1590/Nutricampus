<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cliente = [];

        // Generar registros para los 9 usuarios con id_rol = 2
        for ($i = 2; $i <= 10; $i++) { // Los IDs de los clientes comienzan en 2 (asociados con users.id)
            $cliente[] = [
                'id' => $i, // Relación con users.id
                'nombre' => 'Nombre Cliente ' . $i,
                'apellido' => 'Apellido Cliente ' . $i,
                'direccion' => 'Dirección Cliente ' . $i,
                'preferencias' => 'Preferencias Cliente ' . $i,
                'observaciones' => 'Observaciones Cliente ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insertar los clientes en la tabla
        DB::table('cliente')->insert($cliente);
    }
}
