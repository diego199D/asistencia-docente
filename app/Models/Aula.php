<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'capacidad',
    ];

    // Relación: un aula puede tener muchos horarios
    public function horarios()
    {
        return $this->hasMany(Horario::class, 'aula_id');
    }
}