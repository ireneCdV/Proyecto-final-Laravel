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
    
        $email = $request->email;
        $codAdmin = $request->cod_admin;
    
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user->es_administrador = $user->cod_admin !== null;
    
            if ($user->es_administrador) {
                if (!$codAdmin || $user->cod_admin !== $codAdmin) {
                    Auth::logout();
                    return back()->withErrors(['message' => 'Debe proporcionar un código de administrador válido.']);
                }
            } elseif ($codAdmin) {
                Auth::logout();
                return back()->withErrors(['message' => 'Solo los administradores pueden proporcionar un código de administrador.']);
            }
    
            return redirect()->intended('/dashboard');
        }
    
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
