<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], true)){
            $user = Auth::user();
            $user->isActive = true;
            $user->update();
            return response()->json(Auth::user(), 200);
        }
        else {
            return response()->json(['message' => 'Could not log in, email or password do not match'], 401);
        } 
    }

    public function logout(){
        $user = Auth::user();
        $user->isActive = false;
        $user->update();
        Auth::logout();
    }
}
