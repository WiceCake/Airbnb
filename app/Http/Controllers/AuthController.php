<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function index(Request $request){
        if(Auth::guard('web')->check()){
            return redirect('/');
        }
        return view('login');        
    }

    public function login(Request $request){
        $validate = $request->validate([
            'username' => 'required|exists:managers,username',
            'password' => 'required'
        ]);

        if(Auth::guard('web')->attempt($validate)){
            $user = Auth::guard('web')->user();
            $user->setRememberToken(session()->getId());

            return redirect('/');
        }
        
        return back()->withErrors([
            'password' => 'Password not matched'
        ]);
    }

    public function logout(){

        $user = Auth::guard('web')->user();

        $user->setRememberToken(null);

        Auth::logout();

        return redirect('/login');
    }
}
