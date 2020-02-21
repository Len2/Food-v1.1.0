<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PageFollowers;

class PageFollowersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_followers = PageFollowers::get();
        if(is_null($page_followers))
        {
            return response()->json("No Page Followers",404);
        }

        return response()->json($page_followers,200);
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
            'page_id' => 'required',
            'user_id' => 'required',
            ]);
    
            $page_followers=PageFollowers::create($request->all());
            return response()->json($page_followers,201);   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_followers=PageFollowers::find($id);
        if(is_null($page_followers)){
            return response()->json("Page follower ".$id.",not found",404);
        }
        return response()->json($page_followers,200);
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
        
        $page_followers=PageFollowers::find($id);
        $validator = $request->validate([
            'page_id' => ['exists:page,id|regex:/^[0-9]+$/'],
            'user_id' => ['exists:users,id|regex:/^[0-9]+$/'],
        ]);

        if(is_null($page_followers)){
            return response()->json("Not found",404);
        } else {
            $page_followers->update($request->all());
            return response()->json($page_followers,200);
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
        $page_followers=PageFollowers::find($id);

        if(is_null($page_followers)){
            return response()->json("Not found",404);
        }
        $page_followers->delete();
        return response()->json(null,200);
    }
}
