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
                'nombre' => 'Nombre Cliente '.$i - 1,
                'apellido' => 'Apellido Cliente '.$i - 1,
                'direccion' => 'Dirección Cliente '.$i - 1,
                'preferencias' => 'Preferencias Cliente '.$i - 1,
                'observaciones' => 'Observaciones Cliente '.$i - 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insertar los clientes en la tabla
        DB::table('cliente')->insert($cliente);
    }
}
