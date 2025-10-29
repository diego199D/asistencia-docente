<?php

namespace App\Http\Controllers;

use App\Models\MiHorario;
use App\Models\Docente;
use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MiHorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtenemos el docente actual (según el usuario autenticado)
        $userId = Auth::id();
        
        // Verifica si el usuario tiene un registro de docente
        $docente = \App\Models\Docente::where('id_usuario', $userId)->first();

        if (!$docente) {
            return back()->with('error', 'No tienes un horario asignado.');
        }

        // Traemos todos los horarios de ese docente con sus relaciones
        $horarios = Horario::with(['materia', 'aula'])
            ->where('docente_id', $docente->id)
            ->orderBy('dia')
            ->orderBy('hora_inicio')
            ->get();

        return view('MisHorarios.index', compact('horarios', 'docente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MiHorario  $miHorario
     * @return \Illuminate\Http\Response
     */
    public function show(MiHorario $miHorario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MiHorario  $miHorario
     * @return \Illuminate\Http\Response
     */
    public function edit(MiHorario $miHorario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MiHorario  $miHorario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MiHorario $miHorario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MiHorario  $miHorario
     * @return \Illuminate\Http\Response
     */
    public function destroy(MiHorario $miHorario)
    {
        //
    }
}
