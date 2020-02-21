<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\Reservation;
use App\UserRole;
use App\User;
use DB;

class ReservationController extends Controller
{
    public function all()
    {
        return Reservation::all();
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
        return $user->reservation;
    }



    public function store(Request $request)
    {   
        $userReservation = $request->all();
        $validator = $request->validate([
            'user_id'=> 'required',
            //'role_id'=> 'required',
            'table_id'=> 'required',
            'page_id'=> 'required',
            'date'=> 'required',
            'time'=> 'required',
            'number_of_persons'=> 'required',
        ]);

        try
        {
            $user = auth()->userOrFail();
        }catch(\Tymon\JWTAuth\Exception\UserNotDefinedException $e)
        {
            return response()->json(["Error:" => $e->getMessage()]);
        }

        $userReservation = $user->reservation()->create($userReservation);
        return DB::table('users')
        ->join('reservations', 'reservations.user_id', '=', 'users.id')
        ->join('user_role', 'user_role.user_id', '=', 'users.id')
        ->select('reservations.id',
                'user_role.role_id',
                //'reservations.user_id',
                'reservations.table_id',
                'reservations.page_id',
                'reservations.date',
                'reservations.time',
                'reservations.number_of_persons'
                )
        ->get();
    }
}
