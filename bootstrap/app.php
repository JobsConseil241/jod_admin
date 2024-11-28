<?php

use App\Http\Middleware\Backend;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        //api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('api')
                ->prefix('api/v1')
                ->group(base_path('routes/api.php'));
        },

    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->append(Backend::class);
        $middleware->append(RedirectIfAuthenticated::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
