<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRole;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userRole= UserRole::get();
        if(is_null($userRole)){
            return response()->json("No User Role",404);
        }
        return response()->json($userRole,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'user_id' => 'required',
            'role_id' => 'required',
            ]);
    
        $userRole = UserRole::create($request->all());
        return response()->json($userRole,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userRole = UserRole::find($id);
        if(is_null($userRole)){
            return response()->json(["Error" => "Specified User Role ".$id.",not founded"],404);
        }
        return response()->json($userRole,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userRole=UserRole::find($id);
        $validator = $request->validate([
            'user_id' => 'exists:users,id|regex:/^[0-9]+$/',
            'role_id' => 'exists:role,id|regex:/^[0-9]+$/',
        ]);

        if(is_null($userRole)){
            return response()->json("Not found",404);
        } else {
            $userRole->update($request->all());
            return response()->json($userRole,200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userRole=UserRole::find($id);
        if(is_null($userRole)){
             return response()->json("Not found",404);
        }
        $userRole->delete();
        return response()->json(null,200);  
    }
}
