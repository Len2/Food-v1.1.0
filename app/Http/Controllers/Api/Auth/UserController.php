<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserController extends Controller
{

    public  function signup (Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        $user = new User([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
                'address_id' => $request->input('address_id'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
    public  function signin (Request $request)
    {
        try{
            $credentials =$request->only('email','password');
            if(! $token = JWTAuth::attempt($credentials)){
                return response()->json([
                    'error' => 'Invalid Credentials'
                ],401);
            }
        }catch(JWTException $e){
            return response()->json([
                'error' => 'Could not create token'
            ],500);
        }
        return response()->json([
            'token' => $token
        ],200);
    }
}
