<?php

namespace App\Http\Controllers\Worker;

use App\CustomerBid;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CustomerBidController extends Controller
{
    //
    public function show($id){
        $setting = Setting::find(1);
        $customerBid = CustomerBid::find(Crypt::decryptString($id));
        return view('worker.job.show-customer-bid',compact('setting', 'customerBid'));
    }
}
