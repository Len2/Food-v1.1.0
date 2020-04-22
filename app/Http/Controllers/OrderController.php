<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('Admin')){
            return OrderResource::collection(Order::get());
        }else{
             $orders=Auth::user()->orders;
            return OrderResource::collection($orders);
        }
    }


//    public function store(CreateOrderRequest $request)
//    {
//        $order = Order::create($request->all());
//        return new OrderResource($order);
//    }


    public function show(Order $order)
    {
        $order->carts;
        return new OrderResource($order);
    }


//    public function update(UpdateOrderRequest $request, Order $order)
//    {
//        $data = $request->only([
//            'user_id', 'page_id', 'table_id', 'date', 'status', 'type', 'current_address_id', 'delivery_address_id',
//        ]);
//
//        $order->update($data);
//        return new OrderResource($order);
//    }


//    public function destroy(Order $order)
//    {
//        $order->delete();
//        return new OrderResource($order);
//    }
}
