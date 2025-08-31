<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
   public function handle(Request $request, Closure $next, ...$guards): Response
{
    {
    dd([
        'middleware' => 'RedirectIfAuthenticated',
        'auth_check' => auth()->check(),
        'user'       => auth()->user(),
        'path'       => $request->path(),
    ]);

    // return $next($request);
}

}
}
