<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::get();
        if(is_null($addresses)){
          return response()->json("No Addresss",404);
        }
        return response()->json($addresses,200);
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
            'longitude'=>'required|regex:/^[0-9]+$/',
            'latitude'=>'required|regex:/^[0-9]+$/',
            'city'=>'required',
            'street'=>'required',
            'zipcode'=>'required|regex:/^[0-9]+$/'
        ]);
        
        $address = Address::create($request->all());
        return response()->json($address,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address=Address::find($id);
        if(is_null($address)){
           return response()->json("Not found",404);
        }
        return response()->json($address,200);
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
        $address = Address::find($id);
        $validator = $request->validate(
           [

          'longitude'=>'regex:/^[0-9]+$/',
          'latitude'=>'regex:/^[0-9]+$/',
          'city'=>'',
          'street'=>'',
          'zipcode'=>'regex:/^[0-9]+$/'

        ]);

        if(is_null($address)){
           return response()->json("Not found",404);
        }

        $address->update($request->all());
        return response()->json($address,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address=Address::find($id);

        if(is_null($address)){
             return response()->json("Not found",404);
        }
        $address->delete();
         return response()->json(null,200);
    }
}
