<?php

namespace App\Http\Controllers\Controller;

use App\Http\Controllers\Controller;
use App\Setting;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $setting = Setting::find(1);
        return view('controller.user.index', compact('setting'));
    }

    public function userStatus(Request $request)
    {
        $request->validate([
           'person' => 'required|exists:users,id'
        ]);
        $user= User::find($request->input('person'));
        if ($user->status == 0){
            $user->status = 1;
        }else{
            $user->status = 0;
        }
        $user->save();
        return response()->json([
            'type' => 'success',
            'user' => $user,
        ]);
    }
}
