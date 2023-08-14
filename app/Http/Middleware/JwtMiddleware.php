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
        try {
            $tokenParts = explode('.', $token);
            $payload = base64_decode($tokenParts[1]);
            $decodedPayload = json_decode($payload, true);
            $expiration = $decodedPayload['exp'];
            $currentTime = time();
            if ($expiration < $currentTime) {
                Session::forget('jwt_token');
                return redirect('login');
            }
            return $next($request);
        } catch (\Exception $e) {
            Session::forget('jwt_token');
            return redirect('login');
        }
    }
}
