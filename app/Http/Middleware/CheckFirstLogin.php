<?php

namespace App\Http\Middleware;

use Closure;

class CheckFirstLogin
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
        if ($session_id['telp'] == null) {
            return redirect('/complete-account');
        } else {
            return $next($request);
        }
        
    }
}
