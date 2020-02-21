<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;


class InvoiceController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices= Invoice::get();
        if(is_null($invoices)){
            return response()->json("No Reservations",404);
        }
        return response()->json($invoices,200);
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
            'user_id' => ['exists:users,id|regex:/^[0-9]+$/'],
            'order_product_id' => ['exists:orders_products,id|regex:/^[0-9]+$/'],
            'restaurant_id' => ['exists:restaurants,id||regex:/^[0-9]+$/'],
            'total' => ['required|regex:/^\d+(\.\d{1,2})?$/'],
            'description' => ['required|string|max:3000|nullable'],
            'date' => ['required|date'],
            'status' => ['required|in:paid,unpaid'],
            'payment_method' => ['required|string|max:50'],
        ]);

        $invoices=Invoice::create($request->all());
        return response()->json($invoices,201);
    }
       
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoices=Invoice::find($id);
         if(is_null($invoices)){
            return response()->json("Not found",404);
        }
        return response()->json($invoices,200);
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
        $invoices=Invoice::find($id);
        $validator = $request->validate([
            'user_id' => ['exists:users,id|regex:/^[0-9]+$/'],
            'order_product_id' => ['exists:orders_products,id|regex:/^[0-9]+$/'],
            'restaurant_id' => ['exists:restaurants,id|regex:/^[0-9]+$/'],
            'total' => ['regex:/^\d+(\.\d{1,2})?$/'],
            'description' => ['string|max:3000|nullable'],
            'date' => ['date'],
            'status' => ['in:paid,unpaid'],
            'payment_method' => ['string|max:50'],
        ]);
    
        if(is_null($invoices)){
             return response()->json("Not found",404);
        }else{
            $invoices->update($request->all());
            return response()->json($invoices,200);
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
        $invoices=Invoice::find($id);
        if(is_null($invoices)){
             return response()->json("Not found",404);
        }
        $invoices->delete();
        return response()->json(null,200);    
    }
}
