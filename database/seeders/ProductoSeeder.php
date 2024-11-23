<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('producto')->insert([
            [
                'nombre' => 'Ensalada de Espinaca y Aguacate',
                'precio' => 12.00,
                'descripcion' => 'Ensalada fresca con espinaca, aguacate, nueces y aderezo de limón.',
                'beneficios' => 'Alta en fibra, grasas saludables y antioxidantes.',
                'disponibilidad' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sopa de Calabaza',
                'precio' => 10.00,
                'descripcion' => 'Crema de calabaza sin lácteos, con especias naturales.',
                'beneficios' => 'Baja en calorías, rica en vitamina A y antioxidantes.',
                'disponibilidad' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Tacos de Coliflor',
                'precio' => 14.00,
                'descripcion' => 'Tacos con coliflor al horno, cilantro fresco y guacamole.',
                'beneficios' => 'Bajo en carbohidratos, rico en fibra y vitamina C.',
                'disponibilidad' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Zoodles con Pesto de Albahaca',
                'precio' => 15.00,
                'descripcion' => 'Tallarines de calabacín con pesto vegano de albahaca y nueces.',
                'beneficios' => 'Alternativa baja en carbohidratos a la pasta tradicional.',
                'disponibilidad' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Curry de Garbanzos',
                'precio' => 18.00,
                'descripcion' => 'Curry vegano con garbanzos, leche de coco y especias.',
                'beneficios' => 'Rico en proteínas vegetales, hierro y antioxidantes.',
                'disponibilidad' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Wrap de Vegetales',
                'precio' => 13.00,
                'descripcion' => 'Tortilla de linaza rellena de vegetales frescos y hummus.',
                'beneficios' => 'Alto en fibra, grasas saludables y proteínas vegetales.',
                'disponibilidad' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Hamburguesa de Portobello',
                'precio' => 16.00,
                'descripcion' => 'Portobello marinado con vegetales frescos en pan integral vegano.',
                'beneficios' => 'Bajo en carbohidratos, rico en antioxidantes y proteínas vegetales.',
                'disponibilidad' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Smoothie Verde',
                'precio' => 8.00,
                'descripcion' => 'Batido de espinaca, pepino, jengibre y limón.',
                'beneficios' => 'Detox natural, bajo en calorías y refrescante.',
                'disponibilidad' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Brochetas de Tofu y Verduras',
                'precio' => 14.00,
                'descripcion' => 'Brochetas de tofu marinado con pimientos, calabacín y cebolla.',
                'beneficios' => 'Rico en proteínas vegetales, bajo en grasas saturadas.',
                'disponibilidad' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Postre de Chía con Frutas',
                'precio' => 9.00,
                'descripcion' => 'Pudín de chía con leche de almendras y frutas frescas.',
                'beneficios' => 'Alto en omega-3, fibra y antioxidantes.',
                'disponibilidad' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
