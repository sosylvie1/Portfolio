<?php


use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // ⚡ Déclaration des alias
        $middleware->alias([
            'auth.message' => \App\Http\Middleware\AuthWithMessage::class,
            'is_admin'     => \App\Http\Middleware\IsAdmin::class,
        ]);

        // ⚡ Ajout global de ton middleware de sécurité
        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();

