<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

use App\SmsSender;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class PasswordController extends Controller
{
    public function resetPassword(Request $request){
        $request->validate([
            'phone' => 'required|exists:users,phone'
        ]);
/*
        $smsSender = new SmsSender();
        $messageResponse = $smsSender->smsSender($request->input('phone'),'Message');
        return $messageResponse;
*/
        $user = User::where('phone', $request->input('phone'))->first();

        if ($user->reset_date != Carbon::today() || $user->reset_count < get_static_option('reset_sms_count')){
            //under available reset sms
            $user->reset_count++; // reset sms counting
            $password = Str::random(4);
            $user->reset_date = Carbon::today();
            $user->password = Hash::make($password);
            $smsSender = new SmsSender();
            $readySms = get_static_option('reset_sms_template').$password.' লগিন করুনঃ '.get_static_option('website');
            $messageResponse = $smsSender->smsSender($user->phone, $readySms);
            if (strpos($messageResponse, 'Successfully')){
                $user->save();
                return response()->json(['message'=>'আপনার নাম্বারে পাসওয়ার্ড পাঠানো হয়েছে। লগইন করুণ !', 'type'=>'success']);
            }else{
                return response()->json(['message'=>'আপনার নাম্বারে পাসওয়ার্ড পাঠানো সম্ভব হচ্ছে না', 'type'=> 'danger']);
            }
        }else{
            //Over available reset sms
            return response()->json(['message'=>'আপনি আজকে সর্বাধিক সংখ্যক চেষ্টা করেছেন।', 'type','danger']);
        }
    }
}
