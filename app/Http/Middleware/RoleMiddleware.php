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
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
{
    if (Auth::check() && (Auth::user()->role === $role || Auth::user()->role === 'admin')) {
        return $next($request);
    }

    abort(403, 'Unauthorized.');
}

}