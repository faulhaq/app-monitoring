<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuruMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sess = session();
        $user_id = $sess->get("user_id");
        $role = $sess->get("role");

        if (!$role || !$user_id) {
            return abort(404);
        }

        if ($role !== "guru") {
            return abort(404);
        }

        return $next($request);
    }
}
