<?php

namespace App\Http\Controllers\Worker;

use App\AdminAds;
use App\AdminNotice;
use App\CustomerGig;
use App\Http\Controllers\Controller;
use App\Job;

use App\User;
use App\WorkerService;
use App\WorkerServiceCategory;
use Carbon\Carbon;
use CreateCustomerGigsTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
            /*
            $c_gigs =DB::table('customer_gigs')
                ->join('worker_and_services', function ($join) {
                    $join->on('customer_gigs.service_id', '=', 'worker_and_services.service_id')
                        ->where('worker_and_services.worker_id', '=', auth()->user()->id);
                })->get();
            dd($c_gigs);
            */
        return view('worker.home.index', compact('categories', 'adminNotice', 'adminAds'));
    }


    /**
     * showJob
     */
    public function showJob($id){

        $customerGig = CustomerGig::find(Crypt::decryptString($id));
        return view('worker.home.show-job',compact('customerGig'));
    }

    /**
     * showServices
     */
    public function showServices($id){

        $category = WorkerServiceCategory::find(Crypt::decryptString($id));
        $adminAds = AdminAds::where('status', '1')
            ->whereDate('starting', '<', Carbon::today()->addDays(1))
            ->whereDate('ending', '>', Carbon::today()->addDays(-1))
            ->get();
        return view('worker.home.show-service',compact('category','adminAds'));
    }

    public function showCustomerGigs($service_id){

        $service = WorkerService::find(Crypt::decryptString($service_id));
        return view('worker.home.gigs',compact('service'));
    }
}
