<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Response;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request): ?string
{
    if (! $request->expectsJson()) {
        return route('inicio'); // Cambia 'inicio' por la ruta a la que deseas redirigir
    }
    
    return Response::json(['error' => 'Debes iniciar sesión.'], 401); // Mensaje de error para solicitudes JSON
}

}
