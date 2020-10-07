<?php

namespace App\Http\Controllers\Customer;

use App\AdminAds;
use App\Http\Controllers\Controller;
use App\Setting;
use Carbon\Carbon;

class JobController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
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

}
