<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        $user = Auth::user();

        foreach ($roles as $role) {
            if ($user->role == $role)
                return $next($request);
        }

        abort(404);
        return;
    }
}
