<?php

namespace App\Http\Controllers\Customer;

use App\CustomerBid;
use App\Http\Controllers\Controller;
use App\Setting;
use App\WorkerBid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Image;

class CustomerBidController extends Controller
{
    public function show($id){
        $setting = Setting::find(1);
        $customerBid = CustomerBid::find(Crypt::decryptString($id));
        if ($customerBid->customer_id == Auth::user()->id){
            return view('customer.job.show-customer-bid', compact('setting', 'customerBid'));
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
            'bid'    => 'required|exists:customer_bids,id',
            'budget' => 'required|numeric|min:1',
        ]);
        $bid = CustomerBid::find($request->input('bid'));
        if ($bid->customer->id == Auth::user()->id){
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

    public function imageUploadToJob(Request $request){
        $request->validate([
            'bid' => 'required|exists:customer_bids,id',
            'image' => 'required|image'
        ]);
        $bid = CustomerBid::find($request->input('bid'));
        if ($bid->image){
            return response()->json([
                'type' => 'warning',
                'message' => 'Image already exist.',
            ]);
        }else{
            if($request->hasFile('image')){
                $image              = $request->file('image');
                $OriginalExtension  = $image->getClientOriginalExtension();
                $image_name         ='Customer bid no.-'.$bid->id.'-image-'. Carbon::now()->format('d-m-Y H-i-s') .'.'. $OriginalExtension;
                $destinationPath    = ('uploads/images/jobs');
                $resize_image       = Image::make($image->getRealPath());
                $resize_image->resize(500, 500, function($constraint){
                    $constraint->aspectRatio();
                });
                $resize_image->save($destinationPath . '/' . $image_name);
                $bid->image    = $image_name;
            }
            $bid->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Image successfully uploaded.',
            ]);
        }
    }

    public function completedJobAndRating(Request $request){
        $request->validate([
            'bid' => 'required|exists:customer_bids,id',
        ]);
        $bid = CustomerBid::find($request->input('bid'));
        if ($bid->customer_id == Auth::user()->id){
            $bid->status = 'completed';
            $bid->save(); //Job status updated
            //Rating

            $bid->workerGig->worker->rating->max_rate +=  5;
            $bid->workerGig->worker->rating->save();

            if ($request->input('rate') > 0){
                $bid->workerGig->worker->rating->rate +=  $request->input('rate');
                $bid->workerGig->worker->rating->save();
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully job completed with star-'.$request->input('rate'),
                ]);
            }else{
                return response()->json([
                    'type' => 'success',
                    'message' => 'Successfully job completed',
                ]);
            }

        }else{
            return redirect()->back();
        }

    }
}
