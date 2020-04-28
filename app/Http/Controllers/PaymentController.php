<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use Illuminate\Http\Request;
use Stripe\Exception\CardException;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;

use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\WebProfile;
use PayPal\Api\InputFields;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;

class PaymentController extends Controller
{
    public function  apiContext(){
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AT-VJCSpBSsDnSOsrRtcRVcva7dhlgXMfJmjkYSDFVx8AFXY9Pm9SQ2keRJlYoKOmyGMoJ1g91IGCSxf',     // ClientID
                'EFrlJkFY5W50CUJ8e48XLUCqC7ULv0p5zATEXmF2MyJpzoz0Le3ZvxaleIc9nwTQZYxh8y9-jK49F87g'      // ClientSecret
            )
        );
        return $apiContext;
    }

    public function fieldsOrder(Request $request){
        return $fields=[
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
        ];
    }

    public function create_payment(){
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
//        foreach(Cart::content() as $key=>$cart){
//            $item1 = new Item();
//            $item1->setName($cart->name)
//                ->setCurrency('EUR')
//                ->setQuantity($cart->qty)
//                ->setSku($cart->rowId) // Similar to `item_number` in Classic API
//                ->setPrice($cart->price);
//            $items[]=$item1;
//        }

        $item1 = new Item();
        $item1->setName('Ground Coffee 40 oz')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku("123123") // Similar to `item_number` in Classic API
            ->setPrice(7.5);
        $item2 = new Item();
        $item2->setName('Granola bars')
            ->setCurrency('USD')
            ->setQuantity(5)
            ->setSku("321321") // Similar to `item_number` in Classic API
            ->setPrice(2);
        $itemList = new ItemList();
        $itemList->setItems(array($item1, $item2));//$item2
        $details = new Details();

        $details->setShipping(1.2)
            ->setTax(1.3)
            ->setSubtotal(17.50);


        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal(20)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://laravel-paypal-example.test")
            ->setCancelUrl("http://laravel-paypal-example.test");
        // Add NO SHIPPING OPTION
        $inputFields = new InputFields();
        $inputFields->setNoShipping(1);
        $webProfile = new WebProfile();
        $webProfile->setName('test' . uniqid())->setInputFields($inputFields);
        $webProfileId = $webProfile->create($this->apiContext())->getId();
        $payment = new Payment();
        $payment->setExperienceProfileId($webProfileId); // no shipping
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->apiContext());
        } catch (Exception $ex) {
            echo $ex;
            exit(1);
        }
        return $payment;

    }

    public function execute_payment(Request $request){
        $paymentId = $request->paymentID;
        $payment = Payment::get($paymentId, $this->apiContext());
        $execution = new PaymentExecution();
        $execution->setPayerId($request->payerID);
        // $transaction = new Transaction();
        // $amount = new Amount();
        // $details = new Details();
        // $details->setShipping(2.2)
        //     ->setTax(1.3)
        //     ->setSubtotal(17.50);
        // $amount->setCurrency('USD');
        // $amount->setTotal(21);
        // $amount->setDetails($details);
        // $transaction->setAmount($amount);
        // $execution->addTransaction($transaction);
        try {
            $pay= $request->amount/100;
            $addOther =[
                'payment_id' =>$paymentId,
                'amount' => $pay,
                'currency' => "eur",
                'method_payment' => "PayPal"
            ];
            $result = $payment->execute($execution, $this->apiContext());

            $fields= $this->fieldsOrder($request);
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

        } catch (Exception $ex) {
            echo $ex;
            exit(1);
        }
        return $result;
    }




    //Stripe integration
    public  function postCheckout(Request $request){
        Stripe::setApiKey('sk_test_6hFmLEhgP42enEBBk8gL9DeJ');
        try {
            $fields= $this->fieldsOrder($request);
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
                'currency' => $charge->currency,
                'method_payment' => "Stripe",
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
