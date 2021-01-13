<?php

namespace App\Http\Middleware\Jwt;
use Closure;
use Exception;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Manager;
class JwtSpecialist extends BaseMiddleware
{


    public function handle($request, Closure $next)
    {

        try {

            $user = JWTAuth::parseToken()->authenticate();
            // if ($user->rol_id !== 2) {
            //     // verifica que el usuario sea admin
            //     return response()->json('usuario no autorizado',401);
            // }

        } catch (JWTException $e) {
            if ($e instanceof TokenExpiredException){
                // refrescar eltoken si ya expiro
                $newToken = JWTAuth::parseToken()->refresh();
                $user = JWTAuth::setToken($newToken)->toUser();
                $request->headers->set('Authorization', 'Bearer' . $newToken);
                $response = $next($request);
                $response->headers->set('Authorization', $newToken);
                return $response;

            }else if ($e instanceof TokenInvalidException) {
                return response()->json(['mensaje' => 'token no valido'],401);
            }else{
                return response()->json(['mensaje' => 'token no found'],401);
            }

        }

        return $next($request);

    }
}
