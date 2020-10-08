<?php

namespace App\Http\Controllers\Worker;

use App\CustomerBid;
use App\Http\Controllers\Controller;
use App\Setting;
use App\WorkerBid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CustomerBidController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){
        $setting = Setting::find(1);
        $customerBid = CustomerBid::find(Crypt::decryptString($id));
        return view('worker.job.show-customer-bid',compact('setting', 'customerBid'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCustomerBidBudget(Request $request){
        $request->validate([
            'bid' => 'required|exists:customer_bids,id',
            'budget' => 'required|numeric'
        ]);

        $bid = CustomerBid::find($request->input('bid'));
        if ($bid->workerGig->worker->id == Auth::user()->id){
            if ($bid->budget > $request->input('budget')){
                return response()->json([
                    'type' => 'warning',
                    'message' => 'This price is not acceptable',
                ]);
            }else{
                $bid->budget = $request->input('budget');
                $bid->save();
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully price updated',
                ]);
            }
        }else{
            return response()->json([
                'type' => 'danger',
                'message' => 'Not permitted',
            ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function acceptCustomerBid(Request $request){
        $request->validate([
            'bid' => 'required|exists:customer_bids,id',
        ]);

        $bid = CustomerBid::find($request->input('bid'));
        if ($bid->workerGig->worker->id == Auth::user()->id){
            $bid->status = 'running';
            $bid->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully accepted',
            ]);

        }else{
            return response()->json([
                'type' => 'danger',
                'message' => 'Not permitted',
            ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function rejectCustomerBid(Request $request){
        $request->validate([
            'bid' => 'required|exists:customer_bids,id',
        ]);

        $bid = CustomerBid::find($request->input('bid'));
        if ($bid->workerGig->worker->id == Auth::user()->id){
            $bid->status = 'cancelled';
            $bid->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully cancelled',
            ]);

        }else{
            return response()->json([
                'type' => 'danger',
                'message' => 'Not permitted',
            ]);
        }
    }
}
