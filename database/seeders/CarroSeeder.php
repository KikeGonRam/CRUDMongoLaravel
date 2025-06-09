<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carro;
use Faker\Factory as Faker;

class CarroSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $batchSize = 100; // Insertar en batches para no saturar memoria
        $total = 50000; // Total de registros a insertar

        for ($i = 0; $i < $total / $batchSize; $i++) {
            $data = [];

            for ($j = 0; $j < $batchSize; $j++) {
                $data[] = [
                    'marca' => $faker->company(),
                    'modelo' => $faker->word(),
                    'anio' => $faker->numberBetween(1990, 2025),
                    'precio' => $faker->randomFloat(2, 5000, 100000),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            Carro::insert($data); // Inserción masiva
            echo "Insertados " . (($i + 1) * $batchSize) . " registros\n";
        }
    }
}
