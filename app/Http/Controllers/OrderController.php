<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::get();
        if(is_null($order)){
          return response()->json(["Error"=>"Order, not found"],404);
        }
        return response()->json(["data" => $order],200);
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
        $request->validate([
            'user_id'               => 'required',
            'page_id'               => 'required',
            'table_id'              => '',
            'date'                  => 'required',
            'status'                => 'required',
            'type'                  => 'required',
            'current_location_id'   => 'required',
            'delivery_location_id'  => 'required',
        ]);

        $order = Order::create($request->all());

        return response()->json(["data" => $order],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        if(is_null($task)){
           return response()->json(["Error"=>"Order, not found"],404);
       }
       return response()->json(["data" => $order],200);
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
        $order = Order::find($id);

        $validate = $request->validate(
        [
            'user_id'               => 'regex:/^[0-9]+$/',
            'page_id'               => 'regex:/^[0-9]+$/',
            'table_id'              => '',
            'date'                  => 'string',
            'status'                => 'string',
            'type'                  => 'string',
            'current_location_id'   => 'regex:/^[0-9]+$/',
            'delivery_location_id'  => 'regex:/^[0-9]+$/',
        ]);

        if(is_null($order)){
             return response()->json(["Error"=>" not found"],404);
        }

        $order->update($request->all());
        return response()->json(["data" => $order],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order=Order::find($id);
        if(is_null($order)){
             return response()->json(["Error"=>" not found"],404);
        }
        
        $order->delete();
        return response()->json(null,200);
    }
}
