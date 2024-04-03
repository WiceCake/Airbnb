<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Guest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   
    public function register(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|unique:guests,username|min:6',
            'password' => 'required|min:8',
            'full_name' => 'required'
        ]);

        $guest = Guest::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'fullname' => $request->full_name,
            'registered_date' => now() 
        ]);

        $token = md5(microtime() . $guest->username . Str::random(60));

        $guest->setRememberToken($token);

        return response()->json([
            'status' => 'success',
            'token' => $guest->getRememberToken->token
        ], 201);

    }

    public function login(Request $request){
        $validate = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        

        $guest = Guest::where('username', $request->username)->first();

        if(!$guest || !Hash::check($request->password, $guest->password)){
            return response()->json([
                'status' => 'unauthorized',
                'message' => 'Wrong username or password'
            ],401);
        }

        $token = md5(microtime() . $guest->username . Str::random(60));

        $guest->setRememberToken($token);

        return response()->json([
            'status' => 'success',
            'token' => $guest->getRememberToken->token
        ], 200);
    }

    public function logout(){
        $guest = Guest::whereHas('getRememberToken', function($q) {
            return $q->where('token', request()->bearerToken());
        })->first();

        $guest->setRememberToken(null);

        return response()->json([
            'status' => 'success'
        ]);
    }

}
