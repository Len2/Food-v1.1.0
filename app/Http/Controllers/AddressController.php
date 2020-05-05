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

    function __construct()
    {
        if(Auth::guard("user_pages")->user()== ''){
            $this->user=Auth::guard("api")->user();
        }else{
            $this->user=Auth::guard("user_pages")->user();
        }
    }

    public function index()
    {
        $address=$this->user->address;
        return AddressResource::collection($address);
    }

    public function store(CreateAddressRequest $request)
    {
        $address =new Address;

        $address->longitude =$request->longitude;
        $address->latitude =$request->latitude;
        $address->city =$request->city;
        $address->street =$request->street;

        $address->zip_code =$request->zip_code;
        $address->phone_number1 =$request->phone_number1;
        $address->phone_number2 =$request->phone_number2;

        // $address= $request->all();
        $this->user->address()->save($address);
        return new AddressResource($address);
    }


//    public function show(Address $address)
//    {
//        return new AddressResource($address);
//    }

    public function update(UpdateAddressRequest $request, Address $address)
    {
        $address->longitude =$request->longitude;
        $address->latitude =$request->latitude;
        $address->city =$request->city;
        $address->street =$request->street;

        $address->zip_code =$request->zip_code;
        $address->phone_number1 =$request->phone_number1;
        $address->phone_number2 =$request->phone_number2;

        // $address= $request->all();
        $this->user->address()->save($address);
        return new AddressResource($address);
    }


    public function destroy(Address $address)
    {
        if($this->user->id == $address->user_id){
        $address->delete();
        return response()->json(null,200);
        }else{
            return response()->json(array("error"=>"You have not permission to access"),401);
        }
    }
}
