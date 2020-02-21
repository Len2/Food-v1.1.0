<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PageUser;

class PageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageUsers=PageUser::get();
        if(is_null($pageUsers)){
            return response()->json("Not found",404);
        }
        return response()->json($pageUsers,200);
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
            //'user_role_id'=>'required|regex:/^[0-9,-]*$/|exists:user_roles,id',
            //'page_role_id'=>'required|regex:/^[0-9,-]*$/|exists:page_roles,id',
            //'page_id'=>'required|regex:/^[0-9,-]*$/|exists:pages,id',
            'user_role_id'=>'required|regex:/^[0-9,-]*$/',
            'page_role_id'=>'required|regex:/^[0-9,-]*$/',
            'page_id'=>'required|regex:/^[0-9,-]*$/',
        ]);
        $pageUser=PageUser::create($request->all());
        return response()->json($pageUser,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pageUser = PageUser::find($id);
        if(is_null($pageUser)){
            return response()->json("not found",404);
        }
        return response()->json($pageUser,200);
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
        $pageUser=PageUser::find($id);
        $validator = $request->validate([
            'user_role_id'=>'regex:/^[0-9,-]*$/',
            'page_role_id'=>'regex:/^[0-9,-]*$/',
            'page_id'=>'regex:/^[0-9,-]*$/',
        ]);

        if(is_null($pageUser)){
            return response()->json("Not found",404);
        } else {
            $pageUser->update($request->all());
            return response()->json($pageUser,200);
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
        $pageUser = PageUser::find($id);
        if(is_null($pageUser)){
         return response()->json("not found",200);
        }
        $pageUser->delete();
        return response()->json(null,200);
    }
}
