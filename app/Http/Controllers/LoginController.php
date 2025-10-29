<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Bitacora;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'correo' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['correo' => $credentials['correo'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            // 🔹 Registrar bitácora de inicio de sesión
            Bitacora::create([
                'user_id' => Auth::id(),
                'ip_address' => $request->ip(),
                'fecha_hora' => Carbon::now(),
                'accion' => 'Inicio de sesión',
            ]);

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'correo' => 'Las credenciales no son válidas.',
        ]);
    }


    public function logout(Request $request)
    {
        //Registrar bitacora de cierre antes de cerrar sesión
        if (Auth::check()) {
            Bitacora::create([
                'user_id' => Auth::id(),
                'ip_address' => $request->ip(),
                'fecha_hora' => Carbon::now(),
                'accion' => 'Cierre de sesión',
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
