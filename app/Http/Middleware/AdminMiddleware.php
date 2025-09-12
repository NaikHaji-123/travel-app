<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // kalau bukan admin, tendang ke dashboard jamaah atau login
        return redirect()->route('jamaah.dashboard')->with('error', 'Anda tidak punya akses ke halaman admin!');
    }
}
