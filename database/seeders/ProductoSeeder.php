<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $batchSize = 100; // Tamaño del batch para no saturar memoria
        $total = 50000; // Total de registros a insertar

        for ($i = 0; $i < $total / $batchSize; $i++) {
            $data = [];

            for ($j = 0; $j < $batchSize; $j++) {
                $data[] = [
                    'nombre' => $faker->word(),
                    'precio' => $faker->randomFloat(2, 1, 1000),
                    'descripcion' => $faker->sentence(10),
                    'foto' => 'productos/default.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            \App\Models\Producto::insert($data); // Inserción masiva
            echo "Insertados " . (($i + 1) * $batchSize) . " productos\n";
        }
    }
}
