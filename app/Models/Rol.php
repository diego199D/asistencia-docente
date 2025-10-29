<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'rols'; // 👈 asegúrate que tu tabla se llame así
    protected $fillable = ['nombre'];

    public function run():void{
        $nombres = ['administrador', 'docente', 'trabajador'];
        foreach($nombres as $nombre){
            Rol::create(['nombre' => $nombre]);
        }
    }
}