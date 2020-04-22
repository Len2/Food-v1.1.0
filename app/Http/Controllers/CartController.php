<?php

namespace App\Http\Controllers;

use App\Cart;
//use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    function __construct()
    {
        $this->user = Auth::user();
    }
    public function index()
    {
        $cart=Cart::where("page_id","=",$this->user->page->id)->get();
        return $cart;
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
