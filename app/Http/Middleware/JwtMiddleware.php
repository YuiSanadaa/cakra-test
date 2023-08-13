<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        $token = Session::get('jwt_token');

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        try {
            $user = JWTAuth::parseToken()->authenticate();
            return $next($request);
        } catch (TokenExpiredException $e) {
            Auth::logout(); // Log the user out if token has expired
            Session::forget('jwt_token');
            return redirect()->route('login')->withErrors(['token_expired' => 'Token has expired. Please log in again.']);
        }
    }
}
