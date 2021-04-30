<?php

namespace App\Http\Middleware;

use Closure;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $roleSession = session('session_id.role');
        if ($role == $roleSession) {
            return $next($request);
        }else{
            abort(404);
        }
    }
}
