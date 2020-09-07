<?php

namespace App\Http\Controllers\Customer;

use App\AdminAds;
use App\Http\Controllers\Controller;
use App\Job;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::find(1);

        $adminAds = AdminAds::where('status', '1')
            ->whereDate('starting', '<', Carbon::today()->addDays(1))
            ->whereDate('ending', '>', Carbon::today()->addDays(-1))
            ->get();
        return view('customer.job.index', compact('setting', 'adminAds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
        $job = new Job();

        $job->customer_id   = Auth::user()->id;
        $job->title         = $request->input('title');
        $job->description   = $request->input('description');
        $job->address       = $request->input('address');
        $job->service_id    = $request->input('service');
        $job->day           = $request->input('day');
        $job->budget        = $request->input('budget');

        $job->save();
        return $job;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $setting = Setting::find(1);
        $job = Job::find(Crypt::decryptString($id));
        if ($job->customer_id == Auth::user()->id){
            return view('customer.job.show', compact('setting', 'job'));
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
    public function edit($id)
    {
        $job = Job::find(Crypt::decryptString($id));
        if ($job->customer_id == Auth::user()->id){
            $job->status = 'cancelled';
            $job->save();
            //Add in canceller list
            $cancelJob = new \App\CancelJob();
            $cancelJob->canceller_id = Auth::user()->id;
            $cancelJob->job_id = $job->id;
            $cancelJob->save();
            return redirect()->route('customer.job.show', $id);
        }else{
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
