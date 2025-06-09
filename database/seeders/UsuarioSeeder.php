<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Faker\Factory as Faker;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $batchSize = 1000; // para no saturar memoria
        $total = 50000;

        for ($i = 0; $i < $total / $batchSize; $i++) {
            $data = [];

            for ($j = 0; $j < $batchSize; $j++) {
                $data[] = [
                    'nombre' => $faker->firstName(),
                    'apellido' => $faker->lastName(),
                    'email' => $faker->unique()->safeEmail(),
                    'telefono' => $faker->phoneNumber(),
                    'fecha_nacimiento' => $faker->date(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            Usuario::insert($data);
            echo "Insertados " . (($i + 1) * $batchSize) . " usuarios\n";
        }
    }
}
