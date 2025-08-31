<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Chemin de redirection si l'utilisateur n'est pas authentifié.
     * (Laravel 11 : pas besoin de Kernel, ce middleware est déjà utilisé par l'alias "auth")
     */
   protected function redirectTo($request): ?string
{
    if (! $request->expectsJson()) {
        dd([
            'middleware' => 'Authenticate',
            'auth_check' => auth()->check(),
            'user' => auth()->user(),
        ]);
        return route('login');
    }
    return null;
}

}

