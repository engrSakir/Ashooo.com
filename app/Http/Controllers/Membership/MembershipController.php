<?php

namespace App\Http\Controllers\Membership;

use App\Http\Controllers\Controller;
use App\MembershipPackage;
use Illuminate\Http\Request;
use smasif\ShurjopayLaravelPackage\ShurjopayService;

class MembershipController extends Controller
{
    public function buy(Request $request){
        $request->validate([
           'membership' =>  'required|exists:membership_packages,id',
           'duration'    =>  'required|numeric'
        ]);
        $membership = MembershipPackage::find($request->input('membership'));
        if ($request->input('duration') == 3){
            $paymentAmount = $membership->three_month_price;
        }else if ($request->input('duration') == 6){
            $paymentAmount = $membership->six_month_price;
        }else if ($request->input('duration') == 12){
            $paymentAmount = $membership->twelve_month_price;
        }else{
            return redirect()->back();
        }
        //return redirect()->route('membership.pay', $paymentAmount);
        $shurjopay_service = new ShurjopayService(); //Initiate the object

        $tx_id = $shurjopay_service->generateTxId(); // Get transaction id. You can use custom id like: $shurjopay_service->generateTxId('123456');

        $success_route = route('membership.paymentResponse', [$request->input('membership'), $request->input('duration')]); // optional.

        $shurjopay_service->sendPayment($paymentAmount, $success_route); // You can call simply $shurjopay_service->sendPayment(2) without success route
    }
}
