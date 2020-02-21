<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderTask;

class OrderTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordertasks = OrderTask::get();
        if(is_null($ordertasks)){
            return response()->json("not found",404);
        }

        return response()->json($ordertasks,200);
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
        $validator = $request->validate(
        [
            //'order_id'=>'required|exists:orders,id|regex:/^[0-9]+$/',
           //'users_id'=>'required|exists:users,id|regex:/^[0-9]+$/',
           'order_id'=>'required|regex:/^[0-9]+$/',
           'users_id'=>'required|regex:/^[0-9]+$/',
            'status'=>'required',
            'description'=>'required|string',
        ]);

       $ordertask = OrderTask::create($request->all());
       return response()->json($ordertask,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ordertask = OrderTask::find($id);
        if(is_null($ordertask)){
            return response()->json("Not found");
        }
        return response()->json($ordertask,200);
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
        
        $ordertask = OrderTask::find($id);
        $validator = $request->validate(
        [
            //'order_id'=>'exists:orders,id|regex:/^[0-9]+$/',
            //'users_id'=>'exists:users,id|regex:/^[0-9]+$/',
            'order_id'=>'regex:/^[0-9]+$/',
            'users_id'=>'regex:/^[0-9]+$/',
            'status'=>'string',
            'description'=>'string'
        ]);

       $ordertask->update($request->all());
       return response()->json($ordertask,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ordertask = OrderTask::find($id);
        if(is_null($ordertask)){
            return response()->json("not found",200);
        }
        $ordertask->delete();
        return response()->json(null,200);  
    }
}
