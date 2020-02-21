<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserLike;

class UserLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userLike = UserLike::get();
        if(is_null($userLike)){
            return response()->json(["data" => "No User Like"],404);
        }
        return response()->json(["data" => $userLike],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_user_id' => 'required',
            'product_id' => 'required',
        ]);
 
        $userLike = UserLike::create($request->all());
        return response()->json(['data' => $userLike],200);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userLike = UserLike::find($id);
        if(is_null($userLike)){
            return response()->json(["Error" => "Specified User Like ".$id.",not founded"],404);
        }
        return response()->json(['data' => $userLike],200);
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
        $userLike=UserLike::find($id);
        $validator = $request->validate([
            //'role_user_id' => 'exists:users,id|regex:/^[0-9]+$/',
            //'product_id' => 'exists:role,id|regex:/^[0-9]+$/',
            'role_user_id' => 'regex:/^[0-9]+$/',
            'product_id' => 'regex:/^[0-9]+$/',
            ]);

        if(is_null($userLike)){
            return response()->json(["Error" => "User Like, not found"],404);
        } else {
            $userLike->update($request->all());
            return response()->json(['data' => $userLike],200);
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
        $userLike=UserLike::find($id);
        if(is_null($userLike)){
             return response()->json(["Error" => "User Like, not found"],404);
        }
        $userLike->delete();
        return response()->json(null,200); 
    }
}
