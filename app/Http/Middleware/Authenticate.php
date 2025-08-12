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
            // Message flash affiché après redirection vers /login
            session()->flash('error', 'Vous devez être connecté pour télécharger le CV.');
            return route('login');
        }
        return null;
    }
}

