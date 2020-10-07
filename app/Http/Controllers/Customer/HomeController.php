<?php

namespace App\Http\Controllers\Customer;

use App\AdminAds;
use App\AdminNotice;
use App\Gig;
use App\GigOrder;
use App\Http\Controllers\Controller;
use App\Setting;
use App\WorkerService;
use App\WorkerServiceCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::find(1);
        $categories = WorkerServiceCategory::all();
        $adminNotice = AdminNotice::orderBy('id', 'desc')
            ->take(1)
            ->get();
        $adminAds = AdminAds::where('status', '1')
            ->whereDate('starting', '<', Carbon::today()->addDays(1))
            ->whereDate('ending', '>', Carbon::today()->addDays(-1))
            ->get();
        return view('customer.home.index', compact('setting', 'categories', 'adminNotice', 'adminAds'));
    }

    /**
     * Display the specified resource.
     * Display services of this category
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function showServices($id)
    {
        $setting = Setting::find(1);
        $category = WorkerServiceCategory::find(Crypt::decryptString($id));
        $adminAds = AdminAds::where('status', '1')
            ->whereDate('starting', '<', Carbon::today()->addDays(1))
            ->whereDate('ending', '>', Carbon::today()->addDays(-1))
            ->get();
        return view('customer.home.services',compact('setting', 'category','adminAds'));
    }
}
