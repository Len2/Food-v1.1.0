<?php


namespace App\Http\Controllers;

use App\Http\Requests\Address\CreateAddressRequest;
use App\Http\Requests\Address\UpdateAddressRequest;
use App\Http\Resources\AddressResource;
use Illuminate\Http\Request;
use App\Address;

class AddressController extends Controller
{
    public function index()
    {
        return AddressResource::collection(Address::paginate());
    }


    public function store(CreateAddressRequest $request)
    {
        $address = Address::create($request->all());
        return new AddressResource($address);
    }


    public function show(Address $address)
    {
        return new AddressResource($address);
    }


    public function update(UpdateAddressRequest $request, Address $address)
    {
        $data = $request->only([
            'longitude', 'latitude', 'city', 'street', 'zip_code'
        ]);

        $address->update($data);
        return new AddressResource($address);
    }


    public function destroy(Address $address)
    {
        $address->delete();
        return new AddressResource($address);
    }
}
