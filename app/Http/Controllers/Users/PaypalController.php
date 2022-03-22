<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;


class PaypalController extends Controller
{
    public function handlePayment()
    {
        $input = [];
        $input['items'] = [
            [
                'name' => 'fund',
                'price' => \request()->amount,
            ]
        ];
        $input['invoice_id'] = rand(1, 99);
        $input['invoice_description'] = "Order #{$input['invoice_id']} Bill";
        $input['return_url'] = route('success.payment');
        $input['cancel_url'] = route('cancel.payment');
        $input['total'] = \request()->amount;

        $paypalModule = new ExpressCheckout;
//dd($input);
        $res = $paypalModule->setExpressCheckout($input);
        $res = $paypalModule->setExpressCheckout($input, true);
dd($res);
        return redirect($res['paypal_link']);
    }

    public function paymentCancel()
    {
        return response()->with('failed','Fund With Paypal Cannot Be Made');
    }

    public function paymentSuccess(Request $request)
    {
        $paypalModule = new ExpressCheckout();
        $response = $paypalModule->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            return response()->with('success','Fund With Paypal Has Been Made');

        }
        return response()->with('failed','Fund With Paypal Cannot Be Made');
    }
}
