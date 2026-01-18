<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if user is authenticated
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        // Check if user has the required role
        if (auth()->user()->role !== $role) {
            // Instead of aborting with 403, redirect to user's own dashboard
            if (auth()->user()->role === 'hrm') {
                return redirect()->route('hrm.dashboard');
            } else {
                return redirect()->route('scm.dashboard');
            }
        }

        return $next($request);
    }
}
