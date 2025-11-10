<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        $nombres = ['administrador', 'docente', 'trabajador','coordinador'];

        foreach ($nombres as $nombre) {
            Rol::firstOrCreate(['nombre' => $nombre]);
        }
    }
}