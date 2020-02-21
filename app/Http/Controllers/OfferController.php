<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offer = Offer::get();
        if(is_null($offer)){
          return response()->json(["Error"=>"Offer, not found"],404);
        }
        return response()->json(["data" => $offer],200);
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
            'product_id'        => 'required',
            'page_id'           => 'required',
            'price'             => 'required',
            'description'       => '',
            'status'            => '',
        ]);

        $offer = Offer::create($request->all());

        return response()->json(["data" => $offer],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $offer = Offer::find($id);
        if(is_null($offer)){
           return response()->json(["Error"=>"Offer, not found"],404);
       }
       return response()->json(["data" => $offer],200);
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
        $offer = Offer::find($id);

        $validate = $request->validate(
        [
            'product_id'        => 'required',
            'page_id'           => 'required',
            'price'             => 'required',
            'description'       => '',
            'status'            => '',
        ]);

        if(is_null($offer)){
             return response()->json(["Error"=>" not found"],404);
        }

        $offer->update($request->all());
        return response()->json(["data" => $offer],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer=Offer::find($id);
        if(is_null($offer)){
             return response()->json(["Error"=>" not found"],404);
        }
        
        $offer->delete();
        return response()->json(null,200);
    }
}
