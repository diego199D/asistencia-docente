<?php

namespace App\Http\Controllers;

use App\Models\Aula;

class AulaController extends Controller
{
    public function index()
    {
        // Agrupar aulas por piso
        $aulasPorPiso = Aula::orderBy('piso')->get()->groupBy('piso');

        // Contar aulas disponibles y no disponibles
        $disponibles = Aula::where('disponible', true)->count();
        $noDisponibles = Aula::where('disponible', false)->count();

        return view('aulas.aulas', compact('aulasPorPiso', 'disponibles', 'noDisponibles'));
    }
}