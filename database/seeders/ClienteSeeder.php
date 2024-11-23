<?php
<<<<<<< HEAD

=======
>>>>>>> 805e3361fbf3f8cf84d64439bb09f4c51965dc6d
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
<<<<<<< HEAD
                'nombre' => 'Nombre Cliente ' . $i,
                'apellido' => 'Apellido Cliente ' . $i,
                'direccion' => 'Dirección Cliente ' . $i,
                'preferencias' => 'Preferencias Cliente ' . $i,
                'observaciones' => 'Observaciones Cliente ' . $i,
=======
                'nombre' => 'Nombre Cliente ' . $i-1,
                'apellido' => 'Apellido Cliente ' . $i-1,
                'direccion' => 'Dirección Cliente ' . $i-1,
                'preferencias' => 'Preferencias Cliente ' . $i-1,
                'observaciones' => 'Observaciones Cliente ' . $i-1,
>>>>>>> 805e3361fbf3f8cf84d64439bb09f4c51965dc6d
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insertar los clientes en la tabla
        DB::table('cliente')->insert($cliente);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 805e3361fbf3f8cf84d64439bb09f4c51965dc6d
