<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        auth()->setDefaultDriver('api');
    }

    
    public function authUser()
    {
        try
        {
            $user = auth()->userOrFail();
        } 
        catch(\Tymon\JWTAuth\Exceptions\UserNotDefineException $e)
        {
            return response()->json(['error'=> $e->getMessage()]);
        }
        return $user;
    }
}
