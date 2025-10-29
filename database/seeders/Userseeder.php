<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;  // ✅ para usar Hash::make()

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'usuario'=>'admin',
            'correo' =>'admin@gmail.com',
            'telefono'=>'75686318',
            'password'=>Hash::make('123456'),
            'id_rol'=>1

        ]);

        User::create([
            'usuario' => 'docente',
            'correo' => 'docente@gmail.com',
            'telefono' => '89889874',
            'password'=>Hash::make('123456'),
            'id_rol'=>2
        ]);
    }
}
