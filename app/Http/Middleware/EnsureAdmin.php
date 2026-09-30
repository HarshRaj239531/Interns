<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            return redirect()->route('login')->with('error', 'Administrator credentials required to access this portal.');
        }

        if (! auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized. Administrator privileges required.');
        }

        return $next($request);
    }
}
