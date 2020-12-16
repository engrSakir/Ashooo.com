<?php

namespace App\Http\Controllers\Worker;

use App\CustomerGig;
use App\Http\Controllers\Controller;
use App\Notifications\WorkerBidNotification;

use App\WorkerBid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


class WorkerBidController extends Controller
{

    public function show($id)
    {

        $customerGig = CustomerGig::find(Crypt::decryptString($id));
        return view('worker.job.show-worker-bid', compact(, 'customerGig'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'budget'            => 'required|numeric|min:30',
            'description'       => 'required|string|min:15|max:5000',
            'jobId'            => 'required',
        ]);
        $workerBid = new WorkerBid();

        $workerBid->customer_gig_id   = Crypt::decryptString($request->input('jobId'));
        $workerBid->worker_id   = Auth::user()->id;
        $workerBid->description   = $request->input('description');
        $workerBid->budget        = $request->input('budget');
        $workerBid->save();
        $workerBid->customerGig->customer->notify(new WorkerBidNotification($workerBid)); //notification send to customer
        return $workerBid;

    }

    public function cancel(Request $request)
    {
        $request->validate([
            'bid' => 'required|exists:worker_bids,id'
        ]);
        $bid = WorkerBid::find($request->input('bid'));
        if ($bid->worker_id == Auth::user()->id){
            $bid->is_cancelled = '1';
            $bid->save();
            //return redirect()->route('worker.showWorkerBid',Crypt::encryptString($bid->customer_gig_id));
            return $bid;
        }else{
            return redirect()->back();
        }
    }

    public function changePriceForMoreWork(Request $request){
        $request->validate([
            'bid' => 'required|exists:worker_bids,id',
            'price' => 'required|numeric'
        ]);
        $bid = WorkerBid::find($request->input('bid'));
        if ($bid->worker->id == Auth::user()->id){
            if ($bid->budget > $request->input('price')){
                return response()->json([
                    'type' => 'warning',
                    'message' => 'This price is not acceptable',
                ]);
            }else{
                $bid->budget = $request->input('price');
                $bid->save();
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully price updated',
                ]);
            }
        }else{
            return response()->json([
                'type' => 'info',
                'message' => 'Not permitted',
            ]);
        }
    }
}
