<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //

    public function login(Request $request){
        $request->validate([
                "email"=> "required|string|email",
                "password"=> "required|string",
        ]);

        $user = User::where("email", $request->email)->first(); 
        if(!$user || !Hash::check($request->password,$user->password)){
            return response()->json(['message'=>'Invalid credentials'],401) ;
    }

    $token=$user->createToken('auth_token')->plainTextToken;
    return response()->json(['access_token' => $token, 'token_type' => 'Bearer']) ;  
}
  public function logout(Request $request){
    $request->user()->tokens()->delete();

    return response()->json(['message' => 'Successfully logged out']) ;
  }
}
