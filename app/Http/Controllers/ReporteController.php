<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aula;
use App\Models\Asistencia;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index()
    {
        // 🔹 Trae todas las aulas con conteo de horarios
        $aulas = Aula::withCount('horarios')->get();

        // 🔹 Agrega columna "estado"
        foreach ($aulas as $aula) {
            $aula->estado = $aula->horarios_count > 0 ? 'Ocupada' : 'Disponible';
        }

        // 🔹 Reporte de asistencias (ya funcional)
        $reporteAsistencia = User::leftJoin('asistencias', 'users.id', '=', 'asistencias.id_usuario')
            ->select(
                'users.id',
                'users.usuario',
                'users.correo',
                DB::raw('COUNT(asistencias.id) as total_asistencias')
            )
            ->groupBy('users.id', 'users.usuario', 'users.correo')
            ->get();

        return view('reportes.index', compact('aulas', 'reporteAsistencia'));
    }
}