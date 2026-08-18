<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $user = Auth::user();
        if ($request->login_type === 'admin') {

            if (!$user->hasAnyRole(['admin', 'supervisor'])) {
                Auth::logout();

                return back()->withErrors([
                    'user_name' => 'You are not allowed to login from the admin panel.',
                ]);
            }

            if ($user->hasRole('admin')) {
                return redirect()->route('admin.index');
            }
        }
        if ($request->login_type === 'customer') {

            if (!$user->hasAnyRole('customer')) {
                Auth::logout();

                return back()->withErrors([
                    'user_name' => 'You are not allowed to login from the customer panel.',
                ]);
            }

            if ($user->hasRole('customer')) {
                return redirect()->route('home');
            }
        }



        return redirect()->intended(route('home', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
