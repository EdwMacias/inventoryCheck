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
        // $allowedOrigin = env('URL_FRONTEND');
        // $origin = $request->headers->get('Origin');
        // $host = $request->headers->get('Host');
        $userAgent = $request->headers->get('User-Agent');

        // if ($origin !== $allowedOrigin) {
        //     return response()->json(['error' => '"aqui" Forbidden', "origin" => $origin, "host" => $host,"headers"=>json_encode($request->headers)], 403);
        // }

        if (strpos($userAgent, 'Postman') !== false || strpos($userAgent, 'curl') !== false) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
