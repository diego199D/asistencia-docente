<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $fillable = ['dia', 'hora_inicio', 'hora_fin', 'docente_id', 'materia_id', 'aula_id'];

    public function docente() { return $this->belongsTo(Docente::class); }
    public function materia() { return $this->belongsTo(Materia::class); }
    public function aula() { return $this->belongsTo(Aula::class); }
    public function asistencias() { return $this->hasMany(Asistencia::class); }
}
