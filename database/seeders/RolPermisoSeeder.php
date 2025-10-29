<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RolPermiso;
class RolPermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol_permisos=[
            ['id_rol'=>1,'id_permiso'=>1],
            ['id_rol'=>1,'id_permiso'=>2],
            ['id_rol'=>1,'id_permiso'=>3],
            ['id_rol'=>1,'id_permiso'=>4],
            ['id_rol'=>1,'id_permiso'=>5],
            ['id_rol'=>1,'id_permiso'=>6],
            ['id_rol'=>1,'id_permiso'=>7],

            ['id_rol'=>2,'id_permiso'=>4],
            ['id_rol'=>2,'id_permiso'=>5],
            ['id_rol'=>2,'id_permiso'=>6],
            ['id_rol'=>2,'id_permiso'=>7],
        ];
        foreach ($rol_permisos as $rol_permiso) {
            RolPermiso::create([
                'id_rol' => $rol_permiso['id_rol'],
                'id_permiso' =>$rol_permiso['id_permiso']
            ]);
    }
}}
