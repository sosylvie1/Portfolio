<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Protection Clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Isolation contextuelle
        $response->headers->set('Cross-Origin-Opener-Policy', 'same-origin');

        // Bloquer le "sniffing" du type MIME
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Politique Referrer
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Permissions Policy
        $response->headers->set('Permissions-Policy', "geolocation=(), microphone=(), camera=()");

        // ✅ CSP seulement en production
        if (app()->environment('production')) {
            $csp = "default-src 'self';
                    img-src 'self' data: https:;
                    style-src 'self' 'unsafe-inline';
                    script-src 'self';
                    connect-src 'self';";

            $response->headers->set(
                'Content-Security-Policy',
                preg_replace('/\s+/', ' ', trim($csp))
            );

            // HSTS (HTTPS uniquement en prod)
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        return $response;
    }
}
