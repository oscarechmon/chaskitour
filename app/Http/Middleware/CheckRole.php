<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect('/'); // Redirigir si no está autenticado
        }

        // Si se especifica un rol, verifica si el usuario tiene ese rol
        if ($role && !Auth::user()->hasRole($role)) {
            return redirect('/'); // Redirigir si no tiene el rol adecuado
        }

        return $next($request);
    }
}
