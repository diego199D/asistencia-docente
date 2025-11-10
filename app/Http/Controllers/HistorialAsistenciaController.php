<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;

class HistorialAsistenciaController extends Controller
{
    /**
     * Muestra el historial completo de asistencias (solo para el administrador).
     */
    public function index()
    {
        // Obtener todas las asistencias con relación al usuario y su rol
        $asistencias = Asistencia::with(['usuario.rol'])
            ->orderBy('fecha', 'desc')
            ->get();

        return view('asistencias.historial', compact('asistencias'));
    }
}
