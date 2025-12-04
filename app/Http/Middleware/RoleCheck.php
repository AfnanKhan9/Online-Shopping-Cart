<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleCheck
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== $role) {
            return redirect()->route('login')->with('error', 'Access denied.');
        }

        return $next($request);
    }
}
