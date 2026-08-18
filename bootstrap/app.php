<?php

use App\Http\Middleware\Redirectadmin;
use App\Http\Middleware\RedirectGuest;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
            'RedirectGuest' => RedirectGuest::class,
            'Redirectadmin' => Redirectadmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // $exceptions->render(function (UnauthorizedException $e) {

        //     if ($e->getMessage() === 'User does not have the right roles.' && auth()->user()->hasRole('customer')) {
        //         return redirect()->route('home');
        //     }

        //     return null; // استخدم السلوك الافتراضي لباقي الاستثناءات
        // });
    })->create();
