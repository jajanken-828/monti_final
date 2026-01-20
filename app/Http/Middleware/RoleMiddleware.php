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
            // Redirect to appropriate dashboard based on role and position
            $user = auth()->user();

            if ($user->role === 'hrm') {
                if ($user->position === 'manager') {
                    return redirect()->route('hrm.manager.dashboard');
                } else {
                    return redirect()->route('hrm.staff.dashboard');
                }
            } else {
                if ($user->position === 'manager') {
                    return redirect()->route('scm.manager.dashboard');
                } else {
                    return redirect()->route('scm.staff.dashboard');
                }
            }
        }

        return $next($request);
    }
}
