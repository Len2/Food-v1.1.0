<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PageRole;

class PageRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_role = PageRole::get();
        if(is_null($page_role))
        {
            return response()->json("No Page Role found",404);
        }
        return response()->json($page_role,200);
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
        $page_role = $request->validate([
            'title' => 'required|string|in:page_role1,page_role2,page_role3',
        ]);

        $page_role = PageRole::create($request->all());
        return response()->json($page_role, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_role = PageRole::find($id);
        if(is_null($page_role)){
            return response()->json("Get failed! Page role ".$id.",not found", 404);
        }
        return response()->json($page_role,200);
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
        $page_role = PageRole::find($id);
        $validate = $request->validate([
            'title' => "string|in:page_role1,page_role2,page_role3",
        ]);
        if(is_null($page_role))
        {
            return response()->json("Update failed! Page role ".$id.", not found");
        }
        $page_role->update($request->all());
        return response()->json($page_role,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page_role = PageRole::find($id);
        if(is_null($page_role))
        {
            return response()->json("Delete failed! Page Role ".$id.", not found");
        }
        $page_role->delete();
        return response()->json($page_role,200);
    }
}
