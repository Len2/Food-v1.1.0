<?php

namespace App\Http\Controllers;

use App\Http\Requests\Offer\CreateOfferRequest;
use App\Http\Requests\Offer\UpdateOfferRequest;
use App\Http\Resources\OfferResource;
use Illuminate\Http\Request;
use App\Offer;

class OfferController extends Controller
{
    public function index()
    {
        return OfferResource::collection(Offer::paginate());
    }


    public function store(CreateOfferRequest $request)
    {
        $offer = Offer::create($request->all());
        return new OfferResource($offer);
    }


    public function show(Offer $offer)
    {
        return new OfferResource($offer);
    }


    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        $data = $request->only([
            'product_id', 'page_id', 'price', 'description', 'status',
        ]);

        $offer->update($data);
        return new OfferResource($offer);
    }


    public function destroy(Offer $offer)
    {
        $offer->delete();
        return new OfferResource($offer);
    }
}
