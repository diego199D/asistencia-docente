<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolPermiso extends Model
{
      protected $table = 'rol_permisos'; // 👈 nombre exacto de la tabla en la BD
    protected $fillable = ['id_rol', 'id_permiso'];
}
