<?php

namespace App\Http\Middleware;

use Closure;

class CheckProfessor
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->role !== 'prof') {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}
