<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if (auth()->user()->hasRole('customer')) {
                return $next($request);
            } elseif (auth()->user()->hasRole('admin')) {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('admin.index');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
