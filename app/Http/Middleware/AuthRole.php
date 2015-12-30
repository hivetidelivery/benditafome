<?php

namespace BenditaFome\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param                           $role
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(!Auth::check()) {
            return redirect('/auth/login');
        }

        if(Auth::user()->role <> $role) {
            return redirect('/auth/login');
        }

        return $next($request);
    }
}
