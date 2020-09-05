<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(){
        $setting = Setting::find(1);
        return view('guest.index',compact('setting'));
    }
}
