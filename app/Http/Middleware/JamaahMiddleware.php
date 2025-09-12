<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class JamaahMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'jamaah') {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Silakan login sebagai Jamaah.');
    }
}
