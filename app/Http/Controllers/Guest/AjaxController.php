<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\MembershipService;
use App\Upazila;
use App\WorkerService;
use Illuminate\Http\Request;
use Image;


class AjaxController extends Controller
{
    //Get upazila by specific district
    public function getUpazilaOfDistrict(Request $request){
        $request->validate([
            'districtId' => 'required|exists:upazilas,id',
        ]);
        return Upazila::where('district_id', $request->input('districtId'))->get();
    }

    //Get worker services by specific category
    public function getServicesOfCategory(Request $request){
        $request->validate([
            'categoryId' => 'required|exists:worker_services,id',
        ]);
        return WorkerService::where('category_id', $request->input('categoryId'))->get();
    }

    //Get membership services by specific category
    public function getMembershipServicesOfCategory(Request $request){
        $request->validate([
            'categoryId' => 'required|exists:membership_services,id',
        ]);
        return MembershipService::where('category_id', $request->input('categoryId'))->get();
    }
}
