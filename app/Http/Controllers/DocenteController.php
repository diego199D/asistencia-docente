<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::with('usuario')->latest()->get();
        return view('docentes.docentes', compact('docentes'));
    }
    public function store(Request $request)
    {
        //Crear usuario
        $user = User::create([
            'usuario' => $request->usuario,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),
            'id_rol' => 2 // rol docente
        ]);

        //Crear docente vinculado
        Docente::create([
            'nombre' => $request->nombre,
            'fechaContrato' => $request->fechaContrato,
            'id_usuario' => $user->id
        ]);

        return redirect()->back()->with('success', 'Docente creado correctamente');
    }

    public function update(Request $request, $id)
    {
        $docente = Docente::findOrFail($id);
        $usuario = $docente->usuario;

        // Actualiza los datos
        $docente->update([
            'nombre' => $request->nombre,
            'fechaContrato' => $request->fechaContrato,
        ]);

        $usuario->update([
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'password' => $request->filled('password') ? Hash::make($request->password) : $usuario->password,
        ]);

        return redirect()->back()->with('success', 'Docente actualizado correctamente.');
    }

    public function destroy($id)
    {
        $docente = Docente::findOrFail($id);

        // Guardamos el id del usuario antes de borrar el docente
        $idUsuario = $docente->id_usuario;

        // Eliminamos primero el docente
        $docente->delete();

        //eliminamos el usuario asociado
        User::find($idUsuario)?->delete();

        return redirect()->route('docentes.index')->with('success', 'Docente eliminado correctamente.');
    }
}
