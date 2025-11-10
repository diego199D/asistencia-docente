<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use Illuminate\Support\Facades\Auth;

class AsistenciaController extends Controller
{
    public function index()
    {
        // Mostrar las asistencias del usuario logueado
        $asistencias = Asistencia::where('id_usuario', Auth::id())
            ->orderBy('fecha', 'desc')
            ->get();

        return view('asistencias.index', compact('asistencias'));
    }

    public function marcarAsistencia(Request $request)
    {
        $usuario = Auth::user();
        $hoy = now()->toDateString();

        // Evitar duplicado de asistencia diaria
        $yaMarcado = Asistencia::where('id_usuario', $usuario->id)
            ->where('fecha', $hoy)
            ->exists();

        if ($yaMarcado) {
            return redirect()->back()->with('info', 'Ya marcaste tu asistencia hoy.');
        }

        // Registrar nueva asistencia
        Asistencia::create([
            'id_usuario' => $usuario->id,
            'fecha' => $hoy,
            'hora_marcado' => now()->toTimeString(),
            'estado' => 'Presente',
        ]);

        return redirect()->back()->with('success', 'Asistencia registrada correctamente.');
    }
}