<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\SpecialProfile;
use App\SpecialService;
use Illuminate\Http\Request;

class SpecialServiceController extends Controller
{
    public function showSpecialProfiles($special_service_id){
        $special_service_name = SpecialService::find($special_service_id);
        if ($special_service_name != null){
            $special_profiles = auth()->user()->upazila->special_profiles
                ->where('special_service_id', $special_service_id);
            return view('customer.others.special-profiles',compact('special_profiles'))
                ->with('service', $special_service_name);
        }else{
            return redirect()->back();
        }

    }
}
