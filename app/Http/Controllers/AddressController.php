<?php


namespace App\Http\Controllers;

use App\Http\Requests\Address\CreateAddressRequest;
use App\Http\Requests\Address\UpdateAddressRequest;
use App\Http\Resources\AddressResource;
use App\User;
use Illuminate\Http\Request;
use App\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $address=Auth::user()->address;
        return AddressResource::collection($address);
    }


    public function store(CreateAddressRequest $request)
    {
        $user=Auth::user();
        $address =new Address;

        $address->longitude =$request->longitude;
        $address->latitude =$request->latitude;
        $address->city =$request->city;
        $address->street =$request->street;

        $address->zip_code =$request->zip_code;
        $address->phone_number1 =$request->phone_number1;
        $address->phone_number2 =$request->phone_number2;

        // $address= $request->all();
        $user->address()->save($address);
        return new AddressResource($address);
    }


//    public function show(Address $address)
//    {
//        return new AddressResource($address);
//    }


    public function update(UpdateAddressRequest $request, Address $address)
    {
        $user=Auth::user();

        $address->longitude =$request->longitude;
        $address->latitude =$request->latitude;
        $address->city =$request->city;
        $address->street =$request->street;

        $address->zip_code =$request->zip_code;
        $address->phone_number1 =$request->phone_number1;
        $address->phone_number2 =$request->phone_number2;

        // $address= $request->all();
        $user->address()->save($address);
        return new AddressResource($address);
    }


    public function destroy(Address $address)
    {
        if(Auth::user()->id == $address->user_id){
        $address->delete();
        return response()->json(null,200);
        }else{
            return response()->json(array("error"=>"You have not permission to access"),401);
        }
    }
}
