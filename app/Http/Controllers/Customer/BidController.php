<?php

namespace App\Http\Controllers\Customer;

use App\CustomerBid;
use App\CustomerGig;
use App\GigOrder;
use App\Http\Controllers\Controller;
use App\Setting;
use App\WorkerBid;
use App\WorkerGig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class BidController extends Controller
{
    /**
     * Working for My Order 1st section >>> bids
     */
    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id){
        $setting = Setting::find(1);
        $customerBid = CustomerBid::find(Crypt::decryptString($id));
        if ($customerBid->customer_id == Auth::user()->id){
            return view('customer.job.gig-order', compact('setting', 'customerBid'));
        }else{
            return redirect()->back();
        }
    }

    public function cancel($id){
        $customerBid = CustomerBid::find(Crypt::decryptString($id));
        if ($customerBid->customer_id == Auth::user()->id){
            $customerBid->status = 'cancelled';
            $customerBid->save();
            //Add in canceller list
            $cancelJob = new \App\CancelJob();
            $cancelJob->type = 'customer-bid';
            $cancelJob->canceller_id = Auth::user()->id;
            $cancelJob->job_id = $customerBid->id;
            $cancelJob->save();
            return redirect()->route('customer.showMyBidOrder', $id);
        }else{
            return redirect()->back();
        }
    }

    public function updateBudget (Request $request){
        $request->validate([
            'gig'    => 'required|exists:customer_bids,id',
            'budget' => 'required|numeric|min:1',
        ]);
        $customerBid = CustomerBid::find($request->input('gig'));
        if ($customerBid->customer_id == Auth::user()->id){
            $customerBid->budget = $request->input('budget');
            $customerBid->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully budget updated',
            ]);
        }else{
            return response()->json([
                'type' => 'warning',
                'message' => 'Illegal operation',
            ]);
        }
    }
}
