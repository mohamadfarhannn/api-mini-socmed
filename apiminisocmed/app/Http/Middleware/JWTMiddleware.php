<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException; //Untuk mengambil pesan error dari library

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Header authorzation, untuk memeriksa apakah token ada atau tidak
        if (!$request->hasHeader('Authorization')) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        try {
            JWTAuth::parseToken()->authenticate();
        } catch (JWTException $exception) {
            return response()->json(['error' => 'Token not valid'], 401);
        }

        return $next($request);
    }
}
