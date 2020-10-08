<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $setting = Setting::find(1);
        return view('worker.notification.index', compact('setting'));
    }
}
