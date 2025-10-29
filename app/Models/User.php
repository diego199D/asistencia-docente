<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'usuario',
        'correo',
        'telefono',
        'password',
        'id_rol'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 🔹 Relación con el rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    // 🔹 Relación con el docente (si existe)
    public function docente()
    {
        return $this->hasOne(Docente::class, 'id_usuario');
    }
}
