<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Vérifie si l'utilisateur est admin (role = 1).
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user || $user->role !== 1) {
            abort(403, 'Accès refusé : réservé aux administrateurs.');
        }

        return $next($request);
    }
}


