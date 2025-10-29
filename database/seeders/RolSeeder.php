<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol; // ✅ ESTA LÍNEA ES FUNDAMENTAL (importa el modelo)

class RolSeeder extends Seeder
{
    public function run(): void
    {
        $nombres = ['administrador', 'docente', 'trabajador'];

        foreach ($nombres as $nombre) {
            Rol::create([
                'nombre' => $nombre
            ]);
        }
    }
}