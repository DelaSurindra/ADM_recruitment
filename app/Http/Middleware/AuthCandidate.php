<?php

namespace App\Http\Middleware;

use Closure;

class AuthCandidate
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
        $session_id = Session()->get('session_candidate');
        if ($session_id != null) {
            return $next($request);
        }else{
            return back()->with('mustLogin', 'login');
        }
    }
}
