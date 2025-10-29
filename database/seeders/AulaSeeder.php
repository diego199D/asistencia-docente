<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aula;

class AulaSeeder extends Seeder
{
    public function run(): void
    {
        $contador = 1;

        // Piso 1: Aula 1 a Aula 12
        for ($i = 1; $i <= 12; $i++, $contador++) {
            Aula::create([
                'nro_aula' => 'Aula ' . $contador,
                'capacidad' => rand(25, 50),
                'piso' => 'Piso 1',
                'disponible' => true,
            ]);
        }

        // Piso 2: Aula 13 a Aula 24
        for ($i = 1; $i <= 12; $i++, $contador++) {
            Aula::create([
                'nro_aula' => 'Aula ' . $contador,
                'capacidad' => rand(25, 50),
                'piso' => 'Piso 2',
                'disponible' => true,
            ]);
        }

        // Piso 3: Aula 25 a Aula 36
        for ($i = 1; $i <= 12; $i++, $contador++) {
            Aula::create([
                'nro_aula' => 'Aula ' . $contador,
                'capacidad' => rand(25, 50),
                'piso' => 'Piso 3',
                'disponible' => true,
            ]);
        }

        // Piso 4: Aula 37 a Aula 45
        for ($i = 1; $i <= 9; $i++, $contador++) {
            Aula::create([
                'nro_aula' => 'Aula ' . $contador,
                'capacidad' => rand(25, 50),
                'piso' => 'Piso 4',
                'disponible' => true,
            ]);
        }
    }
}