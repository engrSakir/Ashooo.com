<?php

namespace App\Http\Controllers\Customer;

use App\CustomerBid;
use App\Http\Controllers\Controller;
use App\Notifications\CustomerBidNotification;
use App\Referral;
use App\Setting;
use App\WorkerGig;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class CustomerBidController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'gig'               => 'required|string|exists:worker_gigs,id',
            'description'       => 'required|string|min:15|max:5000',
            'address'           => 'required|string|min:3|max:200',
        ]);

        $customerBid = new CustomerBid();
        $customerBid->customer_id = auth()->user()->id;
        $customerBid->worker_gig_id = $request->input('gig');
        $customerBid->budget = WorkerGig::find($request->input('gig'))->budget;
        $customerBid->description = $request->input('description');
        $customerBid->address = $request->input('address');
        $customerBid->save();

        $customerBid->workerGig->worker->notify(new CustomerBidNotification($customerBid)); //Notification send to worker

        return $customerBid;
    }

    public function show($id){
        $setting = Setting::find(1);
        $customerBid = CustomerBid::find(Crypt::decryptString($id));
        if ($customerBid->customer->id == Auth::user()->id){
            return view('customer.job.show-customer-bid', compact('setting', 'customerBid'));
        }else{
            return redirect()->back();
        }
    }

    public function cancel(Request $request){
        $request->validate([
            'bid'    => 'required|exists:customer_bids,id',
        ]);
        $customerBid = CustomerBid::find($request->input('bid'));
        if ($customerBid->customer->id == Auth::user()->id){
            $customerBid->status = 'cancelled';
            $customerBid->save();
            //Add in canceller list
            $cancelJob = new \App\CancelJob();
            $cancelJob->type = 'customer-bid';
            $cancelJob->canceller_id = Auth::user()->id;
            $cancelJob->job_id = $customerBid->id;
            $cancelJob->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully bid cancelled',
            ]);
        }else{
            return response()->json([
                'type' => 'danger',
                'message' => 'operation denied',
            ]);
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
                $image             = $request->file('image');
                $folder_path       = 'uploads/images/jobs/';
                $image_new_name    = Str::random(8).'-jobs-'.'-'.Carbon::now()->format('d-m-Y H-i-s') .'.'. $image->getClientOriginalExtension();
                //resize and save to server
                Image::make($image->getRealPath())->fit(500, 500, function($constraint){
                    $constraint->aspectRatio();
                })->save($folder_path.$image_new_name);
                $bid->image    = $folder_path.$image_new_name;
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

            //Worker balance update
            $bid->workerGig->worker->balance->job_income += $bid->budget;
            $bid->workerGig->worker->balance->due += (get_static_option('admin_percent_on_worker_job')/100) * $bid->budget;
            $bid->workerGig->worker->balance->save();

            /*
            //Balance updated of referral owner
            if (\auth()->user()->referral->by){
                $selectedReferralOwnerBalance = Referral::where('own', auth()->user()->referral->by)->first()->user->balance;
            }
            */
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
