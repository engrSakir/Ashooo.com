<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $setting = Setting::find(1);
        return view('customer.notification.index', compact('setting'));
    }
}
