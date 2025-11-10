<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Docente;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{
    /**
     * Mostrar la lista de usuarios (antes gestión docente)
     */
    public function index()
    {
        // Traemos todos los docentes con su usuario y rol asociado
        $docentes = Docente::with('usuario.rol')->latest()->get();

        // Traemos todos los roles disponibles para el select dinámico
        $roles = Rol::all();

        // Enviamos ambas variables a la vista
        return view('docentes.docentes', compact('docentes', 'roles'));
    }

    /**
     * Guardar un nuevo usuario/docente en la base de datos
     */
    public function store(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:users,correo',
            'telefono' => 'nullable|numeric',
            'fechaContrato' => 'required|date',
            'password' => 'required|string|min:6',
            'id_rol' => 'required|exists:rols,id',
        ]);

        DB::beginTransaction();
        try {
            // Crear usuario
            $user = User::create([
                'usuario' => $request->usuario,
                'correo' => $request->correo,
                'telefono' => $request->telefono,
                'password' => Hash::make($request->password),
                'id_rol' => $request->id_rol, // 👈 ahora dinámico
            ]);

            // Crear docente vinculado
            Docente::create([
                'nombre' => $request->nombre,
                'fechaContrato' => $request->fechaContrato,
                'id_usuario' => $user->id,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Usuario creado correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Error al crear usuario: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al registrar el usuario.');
        }
    }

    /**
     * Actualizar datos del usuario/docente
     */
    public function update(Request $request, $id)
    {
        $docente = Docente::findOrFail($id);
        $usuario = $docente->usuario;

        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:users,correo,' . $usuario->id,
            'telefono' => 'nullable|numeric',
            'fechaContrato' => 'required|date',
            'password' => 'nullable|string|min:6',
            'id_rol' => 'required|exists:rols,id',
        ]);

        DB::beginTransaction();
        try {
            // Actualizamos datos del docente
            $docente->update([
                'nombre' => $request->nombre,
                'fechaContrato' => $request->fechaContrato,
            ]);

            // Actualizamos datos del usuario asociado
            $usuario->update([
                'correo' => $request->correo,
                'telefono' => $request->telefono,
                'password' => $request->filled('password') 
                                ? Hash::make($request->password) 
                                : $usuario->password,
                'id_rol' => $request->id_rol,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Usuario actualizado correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Error al actualizar usuario: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al actualizar el usuario.');
        }
    }

    /**
     * Eliminar un usuario/docente
     */
    public function destroy($id)
    {
        $docente = Docente::findOrFail($id);
        $idUsuario = $docente->id_usuario;

        DB::beginTransaction();
        try {
            // Eliminar docente
            $docente->delete();

            // Eliminar usuario asociado
            User::find($idUsuario)?->delete();

            DB::commit();
            return redirect()->route('docentes.index')->with('success', 'Usuario eliminado correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Error al eliminar usuario: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al eliminar el usuario.');
        }
    }
}