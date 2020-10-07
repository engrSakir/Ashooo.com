<?php

namespace App\Http\Controllers\Customer;

use App\CustomerGig;
use App\Http\Controllers\Controller;
use App\Job;
use App\Setting;
use App\WorkerBid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Image;

class CustomerGigController extends Controller
{
    /**
     * Store job from customer 'HOME'
     * @param Request $request
     * @return Job
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|min:3|max:100',
            'description'       => 'required|string|min:15|max:5000',
            'address'           => 'required|string|min:3|max:200',
            'service'           => 'required|exists:worker_services,id',
            'day'               => 'required|numeric|min:1|max:30',
            'budget'            => 'required|numeric|min:30',
        ]);

        $gig = new CustomerGig();
        $gig->customer_id   = Auth::user()->id;
        $gig->title         = $request->input('title');
        $gig->description   = $request->input('description');
        $gig->address       = $request->input('address');
        $gig->service_id    = $request->input('service');
        $gig->day           = $request->input('day');
        $gig->budget        = $request->input('budget');
        $gig->save();
        return $gig;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     *
     */
    public function show($id)
    {
        $setting = Setting::find(1);
        $gig = CustomerGig::find(Crypt::decryptString($id));
        if ($gig->customer_id == Auth::user()->id){
            return view('customer.job.show-customer-gig', compact('setting', 'gig'));
        }else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * By this edit actually job will be updated by cancel status
     */
    public function cancel($id)
    {
        $gig = CustomerGig::find(Crypt::decryptString($id));
        if ($gig->customer_id == Auth::user()->id){
            //Gig status change
            $gig->status = 'cancelled';
            $gig->save();
            //Add in canceller list
            $cancelJob = new \App\CancelJob();
            $cancelJob->type = 'bid';
            $cancelJob->canceller_id = Auth::user()->id;
            $cancelJob->job_id = $gig->id;
            $cancelJob->save();

            return redirect()->route('customer.showCustomerGig', $id);
        }else{
            return redirect()->back();
        }
    }

    public function selectWorker(Request $request){
        $request->validate([
            'bid' => 'required|exists:worker_bids,id'
        ]);
        $bid = WorkerBid::find($request->input('bid'));
        $bid->is_selected = 1;
        $bid->save();

        $gig = $bid->customerGig;
        $gig->status = 'running'; //Job status running
        $gig->save();
        //All other cancel
        WorkerBid::where('customer_gig_id', $gig->id)->where('id', '!=', $request->input('bid'))->update(['is_cancelled' => 1]);
    }

    public function changePriceForMoreWork(Request $request){
        $request->validate([
            'bid' => 'required|exists:worker_bids,id',
            'price' => 'required|numeric'
        ]);
        $bid = WorkerBid::find($request->input('bid'));
        if ($bid->customerGig->customer->id == Auth::user()->id){
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
                'type' => 'danger',
                'message' => 'Not permitted',
            ]);
        }
    }

    public function imageUploadToJob(Request $request){
        $request->validate([
            'bid' => 'required|exists:worker_bids,id',
            'image' => 'required|image'
        ]);
        $bid = WorkerBid::find($request->input('bid'));
        $customerGig = $bid->customerGig;
        if ($customerGig->image){
            return response()->json([
                'type' => 'warning',
                'message' => 'Image already exist.',
            ]);
        }else{
            if($request->hasFile('image')){
                $image              = $request->file('image');
                $OriginalExtension  = $image->getClientOriginalExtension();
                $image_name         ='Customer gig no.-'.$customerGig->id.'-image-'. Carbon::now()->format('d-m-Y H-i-s') .'.'. $OriginalExtension;
                $destinationPath    = ('uploads/images/jobs');
                $resize_image       = Image::make($image->getRealPath());
                $resize_image->resize(500, 500, function($constraint){
                    $constraint->aspectRatio();
                });
                $resize_image->save($destinationPath . '/' . $image_name);
                $customerGig->image    = $image_name;
            }
            $customerGig->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Image successfully uploaded.',
            ]);
        }
    }

    public function completedJobAndRating(Request $request){
        $request->validate([
            'bid' => 'required|exists:worker_bids,id',
        ]);
        $bid = WorkerBid::find($request->input('bid'));
        $customerGig = $bid->customerGig;
        if ($customerGig->customer_id == Auth::user()->id){
            $customerGig->status = 'completed';
            $customerGig->save(); //Job status updated
            //Rating

            $bid->worker->rating->max_rate +=  5;
            $bid->worker->rating->save();

            if ($request->input('rate') > 0){
                $bid->worker->rating->rate +=  $request->input('rate');
                $bid->worker->rating->save();
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
