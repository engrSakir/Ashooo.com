<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $setting = Setting::find(1);
        return view('worker.profile.index', compact('setting'));
    }
}
