<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Models\Order;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment"
        ]);

        $order= Order::create([
            'name' => 'Dipto',
            'email' => 'dipto393@gmail.com',
            'address'=>'Dhaka',
            'status'=>'Processing',
            'phone' => '01795043334',
            'amount'=> '100',
           ' currency' => 'usd',
        ]);

        Session::flash('success', 'Payment successful!');

       return redirect()->back();
    }


}
