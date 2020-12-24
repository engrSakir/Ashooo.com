<?php

namespace App\Http\Controllers\Customer;

use App\AdminAds;
use App\AdminNotice;
use App\Gig;
use App\GigOrder;
use App\Http\Controllers\Controller;

use App\WorkerService;
use App\WorkerServiceCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = WorkerServiceCategory::all();
        $adminNotice = AdminNotice::orderBy('id', 'desc')
            ->take(1)
            ->get();
        $adminAds = AdminAds::where('status', '1')
            ->whereDate('starting', '<', Carbon::today()->addDays(1))
            ->whereDate('ending', '>', Carbon::today()->addDays(-1))
            ->get();
        //notify()->success('Laravel Notify is awesome!');
        return view('customer.home.index', compact('categories', 'adminNotice', 'adminAds'));
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
        $category = WorkerServiceCategory::find(Crypt::decryptString($id));
        $adminAds = AdminAds::where('status', '1')
            ->whereDate('starting', '<', Carbon::today()->addDays(1))
            ->whereDate('ending', '>', Carbon::today()->addDays(-1))
            ->get();
        return view('customer.home.services',compact('category','adminAds'));
    }
}
