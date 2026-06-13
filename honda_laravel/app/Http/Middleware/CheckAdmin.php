<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (empty(session('user_id'))) {
            return redirect('/login.php');
        }

        if (session('user_level') !== 'admin') {
            return redirect('/index.php?error=acesso_negado');
        }

        return $next($request);
    }
}
