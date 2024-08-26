<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;

class CheckTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasHeader('token')) {

            try{
                $token = \Laravel\Sanctum\PersonalAccessToken::findToken(Crypt::decryptString($request->header('token')));
                $userId = $token->tokenable_id;
                $user=User::find($userId);
            }catch(\Illuminate\Contracts\Encryption\DecryptException $e){
                return response()->json(["message"=>"Unauthenticated"],401);
            }
            
            if ($user) {
                $request->merge(['user' => $user]);
                return $next($request);
            }
        }
        return response()->json(["message"=>"Unauthenticated"],401);
    }
}
