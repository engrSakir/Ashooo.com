<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Referral;
use App\Upazila;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use Psy\Util\Json;

class AjaxController extends Controller
{
    //Get upazila by specific district
    public function getUpazilaOfDistrict(Request $request){
        $request->validate([
            'districtId' => 'required',
        ]);
        return Upazila::where('district_id', $request->input('districtId'))->orderBy('id', 'desc')->get();
    }

    //Submit customer register
    public function submitCustomerRegister(Request $request){
        $request->validate([
            'profilePicture'     => 'required|image|max:5000',
            'userName'  => 'required|string|max:20|unique:users,user_name',
            'fullName'  => 'required|string|max:50',
            'phone'     => 'required|string|max:16|min:11|unique:users',
            'gender'    => 'required|string|max:10',
            'password'  => 'required|min:6|max:50',
            'district'   => 'required|exists:districts,id',
            'upazila'   => 'required|integer|exists:upazilas,id',
            'referralCode'  => 'nullable|exists:referrals,own',
        ]);

        if ($request->input('password') != $request->input('confirmPassword')){
            return response()->json([
                'type' => 'warning',
                'message' => 'Password not match',
            ]);
        }


        $customer = new User();
        $customer->role         =   'customer';
        $customer->full_name    =   $request->input('fullName');
        $customer->user_name    =   $request->input('userName');
        $customer->phone        =   $request->input('phone');
        $customer->gender       =   $request->input('gender');
        $customer->upazila_id   =   $request->input('upazila');
        $customer->password     =   Hash::make($request->input('password'));

        //Auto resize with 20 wide/ 20 height
        if($request->hasFile('profilePicture')){
            $image              = $request->file('profilePicture');
            $OriginalExtension  = $image->getClientOriginalExtension();
            $image_name         =$request->input('userName').'-profile-'. Carbon::now()->format('d-m-Y H-i-s') .'.'. $OriginalExtension;
            $destinationPath    = ('uploads/images/users');
            $resize_image       = Image::make($image->getRealPath());
            $resize_image->resize(500, 500, function($constraint){
                $constraint->aspectRatio();
            });
            $resize_image->save($destinationPath . '/' . $image_name);
            $customer->image    = $image_name;
        }

        $customer->save();

        //Referral
        // Need more generate referral code max -1 10 laks
        do {
            $referral_code = mt_rand( 000001, 999999 );
        } while ( Referral::where( 'own', $referral_code )->exists() );

        $referral = new Referral();
        $referral->user_id  = $customer->id;
        $referral->own      = $referral_code;
        $referral->by       = $request->input('referralCode');
        $referral->save();

        if(Auth::attempt(['phone' => $customer->phone, 'password' => $request->input('password'), 'status' => 1])) {
            Auth::user()->last_login_at = Carbon::now();
            Auth::user()->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully created',
            ]);
        }else{
            return response()->json([
                'type' => 'warning',
                'message' => 'Successfully created',
            ]);
        }
    }
}
