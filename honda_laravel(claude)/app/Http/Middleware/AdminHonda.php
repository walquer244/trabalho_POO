<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminHonda
{
    public function handle(Request $request, Closure $next)
    {
        if (session('user_level') !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Acesso negado. Apenas administradores.');
        }

        return $next($request);
    }
}
