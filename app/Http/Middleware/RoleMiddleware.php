<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $role)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please log in to access this page.'); // Redirect to login if not authenticated
        }

        // Retrieve authenticated user
        $user = Auth::user();

        // Check if user has the required role
        if ($user->usertype !== $role) {
            return redirect('/')->with('error', 'You do not have permission to access this page.'); // Redirect to home or preferred route
        }

        return $next($request); // Continue to the next request if role matches
    }
}
