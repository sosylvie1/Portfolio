<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthWithMessage
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Vous devez être connecté pour accéder à cet document.');
        }

        return $next($request);
    }
}

