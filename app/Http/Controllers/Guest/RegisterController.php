<?php

namespace App\Http\Controllers\Guest;

use App\District;
use App\Http\Controllers\Controller;
use App\Setting;
use App\WorkerServiceCategory;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //getWorkerRegisterForm
    public function getWorkerRegisterForm(){
        $setting = Setting::find(1);
        $districts = District::all();
        $categories= WorkerServiceCategory::all();
        return view('auth.worker-register',compact('setting', 'districts', 'categories'));
    }
}
