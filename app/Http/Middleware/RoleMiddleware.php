<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->to('/') ->withErrors(['login' => 'Please login first.']);
        }

        if (Auth::user()->role !== $role) {
            Auth::logout();
            return redirect()->to('/')->withErrors(['login' => 'Unauthorized access.']);
        }

        return $next($request);
    }
}