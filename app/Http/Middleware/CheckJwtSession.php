<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckJwtSession
{
    public function handle($request, Closure $next)
    {
        $token = Session::get('jwt_token');

        if ($token) {
            // TODO: Verifikasi token dan periksa masa kadaluarsa JWT
            return redirect('/'); // Ganti dengan halaman yang sesuai
        }
        return $next($request);
    }
}