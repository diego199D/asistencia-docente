<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'rols';
    protected $fillable = ['nombre'];

    // Relación inversa con usuarios
    public function usuarios()
    {
        return $this->hasMany(User::class, 'id_rol');
    }
}