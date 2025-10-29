<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Horario;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::all();
        return view('materias.index', compact('materias'));
    }

    public function create()
    {
        return view('materias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sigla' => 'required|string|max:20',
            'nombre' => 'required|string|max:100',
            'grupo' => 'required|string|max:10',
        ]);

        Materia::create($request->all());

        return redirect()->route('materias.index')->with('success', 'Materia registrada correctamente.');
    }

    public function edit(Materia $materia)
    {
        return view('materias.edit', compact('materia'));
    }

    public function update(Request $request, Materia $materia)
    {
        $request->validate([
            'sigla' => 'required|string|max:20',
            'nombre' => 'required|string|max:100',
            'grupo' => 'required|string|max:10',
        ]);

        $materia->update($request->all());

        return redirect()->route('materias.index')->with('success', 'Materia actualizada correctamente.');
    }

    public function destroy(Materia $materia)
    {
        $materia->delete();
        return redirect()->route('materias.index')->with('success', 'Materia eliminada correctamente.');
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}
