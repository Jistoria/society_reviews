<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class CustomRedirectIfAdminUnauthenticated
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
    protected function redirectTo($request)
    {
        // Personaliza el redireccionamiento según tus necesidades
        // Por ejemplo, redireccionar a una ruta específica con un mensaje de error
        return redirect()->route('inicio')->withErrors(['error' => 'Debe iniciar sesión como administrador.']);
    }
}
