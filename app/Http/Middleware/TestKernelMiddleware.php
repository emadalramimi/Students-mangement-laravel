<?php

namespace App\Http\Middleware;

use Closure;

class TestKernelMiddleware
{
    public function handle($request, Closure $next)
    {
        return response('Kernel is working!', 200);
    }
}
