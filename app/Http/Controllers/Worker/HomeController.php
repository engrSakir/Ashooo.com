<?php

namespace App\Http\Controllers\Worker;

use App\AdminAds;
use App\AdminNotice;
use App\Http\Controllers\Controller;
use App\Job;
use App\Setting;
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
        return view('worker.home.index', compact('setting', 'categories', 'adminNotice', 'adminAds'));
    }


    /**
     * showJob
     */
    public function showJob($id){
        $setting = Setting::find(1);
        $job = Job::find(Crypt::decryptString($id));
        return view('worker.home.show-job',compact('setting', 'job'));
    }

    /**
     * showServices
     */
    public function showServices($id){
        $setting = Setting::find(1);
        $category = WorkerServiceCategory::find(Crypt::decryptString($id));
        $adminAds = AdminAds::where('status', '1')
            ->whereDate('starting', '<', Carbon::today()->addDays(1))
            ->whereDate('ending', '>', Carbon::today()->addDays(-1))
            ->get();
        return view('worker.home.show-service',compact('setting', 'category','adminAds'));
    }
}
