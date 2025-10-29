<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'ip_address', 'fecha_hora', 'accion'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
