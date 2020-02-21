<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskList;

class TaskListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasklists = TaskList::get();
        if(is_null($tasklists)){
          return response()->json(["Error"=>"No Tasks"],404);
        }
        return response()->json(["data" => $tasklists],200);
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
        $validate = $request->validate(
        [
            'name'=>'required|string',
            'page_id'=>'required|regex:/^[0-9]+$/'
        //'page_id'=>'required|regex:/^[0-9]+$/|exists:pages,id'
        ]);

        $tasklists = TaskList::create($request->all());
        return response()->json(["data" => $tasklists],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tasklists = TaskList::find($id);
         if(is_null($tasklists)){
            return response()->json(["Error"=>" not found"],404);
        }
        return response()->json(["data" => $tasklists],200);
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
        $tasklists = TaskList::find($id);

        $validate = $request->validate(
        [
            'name'=>'string',
            'page_id'=>'regex:/^[0-9]+$/'
            //'page_id'=>'exists:pages,id|regex:/^[0-9]+$/'
        ]);

        if(is_null($tasklists)){
             return response()->json(["Error"=>" not found"],404);
        }

        $tasklists->update($request->all());
        return response()->json(["data" => $tasklists],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tasklists=TaskList::find($id);
        if(is_null($tasklists)){
             return response()->json(["Error"=>" not found"],404);
        }
        
        $tasklists->delete();
        return response()->json(null,200);
    }
}
