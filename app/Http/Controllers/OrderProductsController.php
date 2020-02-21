<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderProducts;
use Illuminate\Validation\Rule;
use Validator;

class OrderProductsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $orderProducts= OrderProducts::get();
          if(is_null($orderProducts)){
            return response()->json("No products in orders",404);
        }
        return response()->json($orderProducts,200);
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
        $validator=Validator::make($request->all(),
        [
           'orders_id' => 'required',
           'product_id' => 'required',
           'quantity' => 'regex:/^[0-9]+$/',
           'total' => 'regex:/^\d+(\.\d{2})?$/',
        ]);

        if($validator->fails()){
            $response=array('response'=>$validator->messages(),'success'=>false);
            return $response;
        } else {
            $orderProducts=OrderProducts::create($request->all());
            return response()->json($orderProducts,201);
        }
}
       
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderProducts=OrderProducts::find($id);
        if(is_null($orderProducts)){
            return response()->json("Not found",404);
        }
        return response()->json($orderProducts,200);
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
        $orderProducts=OrderProducts::find($id);
        $validator = Validator::make($request->all(), [
            'orders_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'regex:/^[0-9]+$/',
            'total' => 'regex:/^\d+(\.\d{2})?$/',
        ]);
        if(is_null($orderProducts)){
             return response()->json("Not found",404);
        }

        if($validator->fails()){
            $response=array('response'=>$validator->messages(),'success'=>false);
            return $response;
        } else{
            $orderProducts->update($request->all());
            return response()->json($orderProducts,200);
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
        $orderProducts=OrderProducts::find($id);

        if(is_null($orderProducts)){
             return response()->json("Not found",404);
        }

        $orderProducts->delete();
        return response()->json(null,200);    
    }



}
