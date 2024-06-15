<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyFrontendOrigin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $allowedOrigin = env('URL_FRONTEND', 'http://localhost:3000');
        $origin = $request->headers->get('Origin');
        $userAgent = $request->headers->get('User-Agent');

        if ($origin !== $allowedOrigin) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        if (strpos($userAgent, 'Postman') !== false || strpos($userAgent, 'curl') !== false) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
