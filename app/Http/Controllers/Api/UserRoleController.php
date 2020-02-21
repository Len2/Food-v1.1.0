<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\UserRole;

class UserRoleController extends Controller
{
    public function all()
    {
        return UserRole::all();
    }

    public function self()
    {
        try
        {
            $user = auth()->userOrFail();
        }catch(\Tymon\JWTAuth\Exception\UserNotDefinedException $e)
        {
            return response()->json(["Error:" => $e->getMessage()]);
        }
        return $user->userRole;
    }
}
