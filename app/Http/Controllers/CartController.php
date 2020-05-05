<?php

namespace App\Http\Controllers;

use App\Cart;
//use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class CartController extends Controller
{

    function __construct()
    {
            $this->user=Auth::guard("api")->user();
    }
    public function index()
    {
        if (! Gate::allows('cart-list')) {
            throw new AuthorizationException('You have not permission for show users');
        }
        $cart=Cart::where("page_id","=",$this->user->page->id)->get();
        return response()->json(["data" => $cart],200);
    }

//    public function show($id)
//    {
//        $cart=Cart::find($id);
//        if($cart->page_id == Auth::user()->page->id){
//
//           $orders= Auth::user()->orders;
//            return $orders;
//        }else{
//            echo "Not found";
//        }
//
//    }

    public function update(Request $request, $id)
    {
        if (! Gate::allows('cart-edit')) {
            throw new AuthorizationException('You have not permission for change status cart');
        }
        $cart=Cart::find($id);
        if($cart->page_id == $this->user->page->id){
            $cart->status =$request->status;
            $cart->save();
            return $this->index();
        }else{
            return response()->json(array("error"=>"you have not permission to access"),401);
        }
    }
}
