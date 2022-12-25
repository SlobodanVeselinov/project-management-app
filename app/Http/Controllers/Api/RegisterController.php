<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function register(Request $request){
        
        $request->validate([
            'fullName' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
                    'name' => $request->fullName,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
        ]);
        return $user;
    }


     public function createUser(Request $request){
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->email = $request->email;
        $user->password = Hash::make("password");
        $user->save();
        return $user;
    }
}
