<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        $token = Session::get('jwt_token');

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
