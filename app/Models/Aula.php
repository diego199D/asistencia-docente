<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    // Campos permitidos para insertar/actualizar
    protected $fillable = ['nro_aula', 'capacidad', 'piso', 'disponible'];

    // Relación con horarios
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}