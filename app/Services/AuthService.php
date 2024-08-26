<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Http\Requests\SignupRequest;

class AuthService
{

    public function register(SignupRequest $request)
    {
        
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' =>'success',
            'message' => 'signed up successfully',
            'data'=> $user,
        ]);
    }

    public function login(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) 
        {

            $user = Auth::user();
            $token = $user->createToken('inventory')->plainTextToken;
            return $this->respondWithToken($token);
            
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Email or password is incorrect',
            ],401);
        }
    }

    protected function respondWithToken($token)
    {
        $token =explode("|",$token)[1];
        return response()->json([
            'status' =>'success',
            'message' => 'logged in successfully',
            'access_token' => Crypt::encryptString($token),
            'data' => Auth::user(),
        ]);
    }



}