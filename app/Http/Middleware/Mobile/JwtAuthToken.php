<?php

namespace App\Http\Middleware\Mobile;

use Closure;
use JWTAuth;
use Request;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Response;
use App\User;
use \Illuminate\Http\Response as Res;

class JwtAuthToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $token  = $request->header('authorization');
        // dd($token);
        if ($token != null) {
            $token  = trim(str_replace("bearer", "", $token));
            $token  = trim(str_replace("Bearer", "", $token));
            // dd($token);
            $user = User::Where('api_token', $token)->first();
            // dd($user);
            if ($user != null) {                
                JWTAuth::parseToken($token)->authenticate();
            }
        }

        return $next($request);
    }
}
