<?php

namespace App\Http\Controllers;

//use App\Http\Requests\Order\CreateOrderRequest;
//use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
//use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function index()
    {
        if (!Gate::allows('order-list')) {
            throw new AuthorizationException('You have not permission');
        }
        if(Auth::user()->hasRole('Admin')){
            return OrderResource::collection(Order::get());
        }else{
             $orders=Auth::user()->orders;
            return OrderResource::collection($orders);
        }
    }

    public function show(Order $order)
    {
        if (!Gate::allows('order-single')) {
            throw new AuthorizationException('You have not permission');
        }
        $order->carts;
        $order->user->address;
        //$order->user->getRoleNames();
        return new OrderResource($order);
    }
}
