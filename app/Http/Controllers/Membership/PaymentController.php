<?php

namespace App\Http\Controllers\Membership;

use App\Http\Controllers\Controller;
use App\Membership;
use App\Payment;

use Carbon\Carbon;
use Illuminate\Http\Request;
use smasif\ShurjopayLaravelPackage\ShurjopayService;

class PaymentController extends Controller
{
    public function response($membership, $duration, Request $request)
    {
        if ($request->all()['status'] == 'Success'){
            $payment = new Payment();
            $payment->user_id = auth()->user()->id;
            $payment->amount = $request->all()['amount'];
            $payment->tx_id = $request->all()['tx_id'];
            $payment->bank_tx_id = $request->all()['bank_tx_id'];
            $payment->purpose = 'Membership';
            $payment->save();

            $membershipObj = new Membership();
            $membershipObj->user_id = auth()->user()->id;
            $membershipObj->membership_package_id = $membership;
            $membershipObj->duration = $duration;
            $membershipObj->ending_at = Carbon::now()->addMonth($duration);
            $membershipObj->save();
        }else{

        }


        return view('payment-response')->with('status', $request->all()['status']);


        //dd($request->all());
        /**
        "status" => "Failed"
        "msg" => "Action Failed"
        "tx_id" => "NOK5f8a6ade40f21"
        "bank_tx_id" => null
        "amount" => "1200"
        "bank_status" => "CANCEL"
        "sp_code" => "001"
        "sp_code_des" => "Cancel"
        "sp_payment_option" => null
         */
    }
}
