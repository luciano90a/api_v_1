<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            JWTAuth::parseToken()->authenticate();
        }catch( Exception $e){
            if($e instanceof TokenInvalidException){
                return response()->json([
                    "error"=> "token invalido o expirado",
                ],401);
            }
            if($e instanceof TokenExpiredException){
                return response()->json([
                    "error"=> "token invalido o expirado",
                ],401);
            }
            return response()->json([
                "error"=> "token invalido",
            ],401);
        }
        return $next($request);
    }
}
