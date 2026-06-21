<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');

        // Registro de alias de Middleware para control de acceso por equipo
        $middleware->alias([
            'equipo.aceptado' => \App\Http\Middleware\CheckEquipoAceptado::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Aquí puedes registrar el manejo de excepciones personalizado si es necesario
    })->create();
