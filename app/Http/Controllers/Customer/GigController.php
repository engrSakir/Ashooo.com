<?php

namespace App\Http\Controllers\Customer;

use App\AdminAds;
use App\CustomerGig;
use App\Gig;
use App\GigOrder;
use App\Http\Controllers\Controller;
use App\Job;
use App\Setting;
use App\WorkerService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class GigController extends Controller
{



    /**
     * Show worker's gig to customer.
     * Only worker's upazila
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $setting = Setting::find(1);
        $service = WorkerService::find(Crypt::decryptString($id));
        $adminAds = AdminAds::where('status', '1')
            ->whereDate('starting', '<', Carbon::today()->addDays(1))
            ->whereDate('ending', '>', Carbon::today()->addDays(-1))
            ->get();
        return view('customer.home.gigs',compact('setting', 'service','adminAds'));
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function showGigDetail($id)
    {
        $setting = Setting::find(1);
        $gig = Gig::find(Crypt::decryptString($id));
        return view('customer.home.gig-detail',compact('setting', 'gig'));
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function showOrderForm($id)
    {
        $setting = Setting::find(1);
        $gig = Gig::find(Crypt::decryptString($id));
        return view('customer.home.order-form',compact('setting', 'gig'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function submitOrderForm(Request $request)
    {
        $request->validate([
            'gig'               => 'required|string|exists:gigs,id',
            'description'       => 'required|string|min:15|max:5000',
            'address'           => 'required|string|min:3|max:200',
        ]);

        $gigOrder = new GigOrder();
        $gigOrder->customer_id = auth()->user()->id;
        $gigOrder->gig_id = $request->input('gig');
        $gigOrder->budget = Gig::find($request->input('gig'))->price;
        $gigOrder->description = $request->input('description');
        $gigOrder->address = $request->input('address');
        $gigOrder->save();

        return $gigOrder;
    }


}
