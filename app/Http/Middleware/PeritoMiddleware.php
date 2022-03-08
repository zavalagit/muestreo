<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PeritoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if (Auth::check() && (Auth::user()->tipo == 'usuario')) {
           return $next($request);
        }
        elseif (Auth::check() && (Auth::user()->tipo == 'administrador')) {
            return $next($request);
        }

        Auth::logout();
        return redirect('/');

    }
}
