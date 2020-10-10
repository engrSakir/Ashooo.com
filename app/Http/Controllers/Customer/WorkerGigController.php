<?php

namespace App\Http\Controllers\Customer;

use App\AdminAds;
use App\CustomerBid;
use App\Gig;
use App\GigOrder;
use App\Http\Controllers\Controller;
use App\Notifications\CustomerBidNotification;
use App\Setting;
use App\WorkerGig;
use App\WorkerService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class WorkerGigController extends Controller
{
    /**
     * Show worker's gig to customer.
     * Only worker's upazila
     * Specify by service
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
     * Customer home>service>worker gigs> details
     * @param $id
     * @return \Illuminate\View\View
     */
    public function showGigDetail($id)
    {
        $setting = Setting::find(1);
        $gig = WorkerGig::find(Crypt::decryptString($id));
        return view('customer.home.gig-detail',compact('setting', 'gig'));
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function showOrderForm($id)
    {
        $setting = Setting::find(1);
        $gig = WorkerGig::find(Crypt::decryptString($id));
        return view('customer.home.order-form',compact('setting', 'gig'));
    }

}
