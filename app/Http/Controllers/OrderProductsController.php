<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderProduct\CreateOrderProductRequest;
use App\Http\Requests\OrderProduct\UpdateOrderProductRequest;
use App\Http\Resources\OrderProductResource;
use App\OrderProducts;

class OrderProductsController extends Controller
{

    public function index()
    {
        return OrderProductResource::collection(OrderProducts::paginate());
    }


    public function store(CreateOrderProductRequest $request)
    {
        $orderProduct = OrderProducts::create($request->all());
        return new OrderProductResource($orderProduct);
    }


    public function show($id)
    {
        $orderProduct = OrderProducts::findOrFail($id);
        return new OrderProductResource($orderProduct);
    }


    public function update(UpdateOrderProductRequest $request, $id)
    {
        $orderProduct = OrderProducts::findOrFail($id);
        $data = $request->only([
            'order_id', 'product_id', 'quantity', 'total',
        ]);

        $orderProduct->update($data);
        return new OrderProductResource($data);
    }


    public function destroy($id)
    {
        $orderProduct = OrderProducts::findOrFail($id);
        $orderProduct->delete();

        return new OrderProductResource($orderProduct);
    }
}
