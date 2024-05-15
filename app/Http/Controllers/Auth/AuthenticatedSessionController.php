<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'cod_admin' => 'nullable|string|exists:users,cod_admin',
    ]);

    // Extraer email y código de admin
    $email = $request->email;
    $codAdmin = $request->cod_admin;

    // Intenta autenticar como usuario
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si el usuario es administrador
        $user->es_administrador = $user->cod_admin !== null;

        // Verificar si el usuario es administrador y proporcionó un código de administrador
        if ($user->es_administrador && $codAdmin) {
            // Si el usuario es administrador, verificar el código de administrador
            if ($user->cod_admin !== $codAdmin) {
                // Si el código de administrador no coincide, cerrar sesión y mostrar error
                Auth::logout();
                return back()->withErrors(['message' => 'El código de administrador proporcionado no es válido para este usuario.']);
            }
        } elseif ($codAdmin) {
            // Si el usuario no es administrador pero proporcionó un código de administrador,
            // cerrar sesión y mostrar error
            Auth::logout();
            return back()->withErrors(['message' => 'Solo los administradores pueden proporcionar un código de administrador.']);
        }

        // Redirigir al dashboard si la autenticación fue exitosa
        return redirect()->intended('/dashboard');
    }

    // Si las credenciales no son válidas, mostrar error y volver al formulario de inicio de sesión
    return back()->withErrors(['message' => 'Credenciales no válidas']);
}


    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
