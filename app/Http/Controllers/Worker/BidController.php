<?php

namespace App\Http\Controllers\Worker;

use App\Bid;
use App\Http\Controllers\Controller;
use App\Job;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'budget'            => 'required|numeric|min:30',
            'description'       => 'required|string|min:15|max:5000',
            'jobId'            => 'required',
        ]);
        $bid = new Bid();

        $bid->job_id   = Crypt::decryptString($request->input('jobId'));
        $bid->worker_id   = Auth::user()->id;
        $bid->description   = $request->input('description');
        $bid->budget        = $request->input('budget');

        $bid->save();

        return response()->json([
            'id' => Crypt::encryptString($bid->id),
        ]);

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
        return view('worker.job.show', compact('setting', 'job'));
    }

    /**
     * Show the form for editing the specified resource.
     * Bid update by cancel status
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bid = Bid::find(Crypt::decryptString($id));

        if ($bid->worker_id == Auth::user()->id){
            $bid->is_cancelled = '1';
            $bid->save();
            return redirect()->route('worker.bid.show',$id);
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
