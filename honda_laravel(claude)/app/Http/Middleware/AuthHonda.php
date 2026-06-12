<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthHonda
{
    public function handle(Request $request, Closure $next)
    {
        if (empty(session('user_id'))) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
