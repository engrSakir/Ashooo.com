<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(){

        return view('guest.index',compact());
    }
}
