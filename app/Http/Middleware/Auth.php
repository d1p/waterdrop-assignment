<?php

namespace App\Http\Middleware;

use Closure;

class Auth
{
    public function handle($request, Closure $next)
    {
        // load AUTH_TOKEN from .env and check if it matches the one in the request
        $bearerToken = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $bearerToken);

        if (env('AUTH_TOKEN') !== $token) {
            abort(403);
        }
        return $next($request);
    }
}
