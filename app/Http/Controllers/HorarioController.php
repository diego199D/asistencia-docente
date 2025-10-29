<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Docente;
use App\Models\Materia;
use App\Models\Aula;
use App\Models\Asistencia;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index()
    {
        $horarios = Horario::with(['docente', 'materia', 'aula'])->get();
        $docentes = Docente::all();
        $materias = Materia::all();
        $aulas = Aula::all();

        return view('horarios.index', compact('horarios', 'docentes', 'materias', 'aulas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dia' => 'required|string',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'docente_id' => 'required|exists:docentes,id',
            'materia_id' => 'required|exists:materias,id',
            'aula_id' => 'required|exists:aulas,id',
        ]);

        // 1️⃣ Verificar si el docente ya tiene clase en ese horario
        $docenteOcupado = Horario::where('docente_id', $request->docente_id)
            ->where('dia', $request->dia)
            ->where(function ($query) use ($request) {
                $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fin])
                    ->orWhereBetween('hora_fin', [$request->hora_inicio, $request->hora_fin])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('hora_inicio', '<=', $request->hora_inicio)
                            ->where('hora_fin', '>=', $request->hora_fin);
                    });
            })
            ->exists();

        if ($docenteOcupado) {
            return back()->withErrors(['error' => '❌ El docente ya tiene una clase en ese horario.']);
        }

        // 2️⃣ Verificar si el aula está ocupada
        $aulaOcupada = Horario::where('aula_id', $request->aula_id)
            ->where('dia', $request->dia)
            ->where(function ($query) use ($request) {
                $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fin])
                    ->orWhereBetween('hora_fin', [$request->hora_inicio, $request->hora_fin])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('hora_inicio', '<=', $request->hora_inicio)
                            ->where('hora_fin', '>=', $request->hora_fin);
                    });
            })
            ->exists();

        if ($aulaOcupada) {
            return back()->withErrors(['error' => '❌ El aula ya está ocupada en ese horario.']);
        }

        // 3️⃣ Verificar si la materia con el grupo ya tiene clase al mismo tiempo
        $materiaGrupoOcupada = Horario::where('materia_id', $request->materia_id)
            ->where('dia', $request->dia)
            ->where(function ($query) use ($request) {
                $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fin])
                    ->orWhereBetween('hora_fin', [$request->hora_inicio, $request->hora_fin])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('hora_inicio', '<=', $request->hora_inicio)
                            ->where('hora_fin', '>=', $request->hora_fin);
                    });
            })
            ->exists();

        if ($materiaGrupoOcupada) {
            return back()->withErrors(['error' => '❌ La materia con este grupo ya tiene clase en ese horario.']);
        }

        // ✅ Si todo está correcto, se crea el horario
        $horario = Horario::create($request->all());

        // ✅ 4️⃣ Marcar el aula como no disponible
        $aula = Aula::find($request->aula_id);
        if ($aula) {
            $aula->disponible = false;
            $aula->save();
        }

        return redirect()->route('horarios.index')->with('success', '✅ Horario registrado correctamente.');
    }

    public function destroy($id)
    {
        $horario = Horario::findOrFail($id);
        $aula = Aula::find($horario->aula_id);

        // ✅ Eliminar el horario
        $horario->delete();

        // ✅ 5️⃣ Liberar aula (volverla disponible)
        if ($aula) {
            $aula->disponible = true;
            $aula->save();
        }

        return redirect()->route('horarios.index')->with('success', '🟢 Horario eliminado y aula liberada.');
    }

    // Relaciones (por claridad, aunque estas deberían estar en el modelo Horario)
    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}