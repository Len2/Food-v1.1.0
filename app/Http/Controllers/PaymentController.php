<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use Illuminate\Http\Request;
use Stripe\Exception\CardException;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public  function postCheckout(Request $request){
        Stripe::setApiKey('sk_test_6hFmLEhgP42enEBBk8gL9DeJ');
        try {
            $fields=[
                'user_id' => Auth::user()->id,
                'row_id' =>$request->row_id,
                'email' => Auth::user()->email,
                'name_cart' => $request->name_cart,
                'address' => $request->address,
                'city' =>  $request->city,
                'province' => $request->province,
                'zip_code' => $request->zip_code,
                'country' => $request->country,
                'phone' => $request->phone,
                'method_payment' => "Stripe",
            ];
            $charge = Charge::create(array(
                "amount" => $request->amount, //if euro amount in cent
                "currency" => "eur",
                "source" => $request->source, //$request->input('stripeToken'), // obtained with Stripe.js
                "description" => "Ushqimi",
                "metadata" => $fields
            ));
            $pay= $charge->amount/100;
            $addOther =[
                'payment_id' =>$charge->id,
                'amount' => $pay,
                'currency' => $charge->currency
            ];
            $orderReq = array_replace($fields, $addOther);
            $order=Order::create($orderReq);
            foreach ($request->cart as  $c){
                $order->carts()->save(
                    new Cart(
                        [
                            "product_id" =>$c["product_id"],
                            "page_id" => $c["page_id"],

                            "name" => $c["name"],
                            "qty" => $c["qty"],
                            "desc" => $c["desc"],

                            "price" => $c["price"]/100,
                            "tax" => $c["tax"]/100,
                            "total" => $c["total"]/100,
                        ]
                    )
                );
            }
            return response()->json("Thank you for the purchase",200);
        } catch (CardException $e) {
            return back()->withErrors('Errorr!'. $e->getMessage());
        }
    }
}
