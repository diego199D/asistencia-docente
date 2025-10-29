<?php

namespace Database\Seeders;

use App\Models\Docente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
   
    public function run():void
    {
        $this->call(
            [     
                RolSeeder::class,
                PermisoSeeder::class,
                Userseeder::class,
                RolPermisoSeeder::class,
                DocenteSeeder::class,
                AulaSeeder::class,
            ]
            );
    }
}
