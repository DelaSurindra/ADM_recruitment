<?php

namespace App\Http\Middleware;

use Closure;

class AuthUser
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
        $session_id = Session()->get('session_id');
        if ($session_id != null) {
            return $next($request);
        }else{
            return redirect('HR/login');
        }
    }
}
