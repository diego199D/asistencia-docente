<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permiso; 

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nombres = ['permiso', 'rol', 'usuario','docente','grupo','materia','docente_clase','grupo_materia','horario','aulas','asistencia'];

        foreach ($nombres as $nombre) {
            Permiso::create([
                'nombre' => $nombre
            ]);
    }
}
}
