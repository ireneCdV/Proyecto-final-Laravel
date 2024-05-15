<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }


/*     public function handle($request, Closure $next)
    {
        // Realiza alguna lógica de middleware aquí
        
        // Por ejemplo, verificar el rol del usuario antes de permitir el acceso
        if ($request->user()->isAdmin()) {
            return $next($request); // Si el usuario es administrador, pasa al siguiente middleware o controlador
        }
        
        // Si el usuario no es administrador, puedes redirigirlo o devolver una respuesta de error
        return response('No tienes permiso para acceder a esta página', 403);
    } */
}
