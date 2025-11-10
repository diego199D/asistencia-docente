<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'dia',
        'hora_inicio',
        'hora_fin',
        'docente_id',
        'materia_id',
        'aula_id',
    ];

    // 🔹 Relación con Docente
    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docente_id');
    }

    // 🔹 Relación con Materia
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    // 🔹 Relación con Aula
    public function aula()
    {
        return $this->belongsTo(Aula::class, 'aula_id');
    }
}
