<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){

        return view('worker.profile.index');
    }
}
