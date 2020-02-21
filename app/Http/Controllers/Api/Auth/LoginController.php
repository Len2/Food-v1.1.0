<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $creeds = $request->only(['email','password']);

        if(!$token = auth()->attempt($creeds)){
            return response()->json(['Error:' => "Incorrect email or password"], 401);
        }
        return response()->json(['token' => $token],200);
    }

    /**/ 
    public function refresh()
    {
        try{
            $newToken = auth()->refresh();
        }catch(\Tymon\JWTAuth\Exception\TokenInvalidException $e){
            return response()->json(["Error:" => $e->getMessage()], 401);
        }
        return response()->json(["token" => $newToken]);
    }
}