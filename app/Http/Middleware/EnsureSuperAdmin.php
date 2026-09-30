<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            return redirect()->route('login')->with('error', 'Super Admin root privileges required to access this portal.');
        }

        if (! auth()->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized. Super Admin root privileges required.');
        }

        return $next($request);
    }
}
