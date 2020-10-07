<?php

namespace App\Http\Controllers\Customer;

use App\AdminAds;
use App\Http\Controllers\Controller;
use App\MembershipService;
use App\MembershipServiceCategory;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class GeneralServiceController extends Controller
{
    public function showGeneralServiceCategory(){
        $setting = Setting::find(1);
        $categories = MembershipServiceCategory::all();
        $adminAds = AdminAds::where('status', '1')
            ->whereDate('starting', '<', Carbon::today()->addDays(1))
            ->whereDate('ending', '>', Carbon::today()->addDays(-1))
            ->get();
        return view('customer.others.category',compact('setting','adminAds', 'categories'));
    }

    public function showMembershipServices($id){
        $setting = Setting::find(1);
        $category = MembershipServiceCategory::find(Crypt::decryptString($id));
        $adminAds = AdminAds::where('status', '1')
            ->whereDate('starting', '<', Carbon::today()->addDays(1))
            ->whereDate('ending', '>', Carbon::today()->addDays(-1))
            ->get();
        return view('customer.others.services',compact('setting', 'category','adminAds'));
    }

    public function showMembers($id){
        $setting = Setting::find(1);
        $service = MembershipService::find(Crypt::decryptString($id));
        return view('customer.others.member',compact('setting', 'service'));
    }
}
