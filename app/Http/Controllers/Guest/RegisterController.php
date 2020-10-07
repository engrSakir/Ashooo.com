<?php

namespace App\Http\Controllers\Guest;

use App\Balance;
use App\District;
use App\Http\Controllers\Controller;
use App\MembershipAndService;
use App\MembershipService;
use App\MembershipServiceCategory;
use App\Nid;
use App\Rating;
use App\Referral;
use App\Setting;
use App\User;
use App\WorkerAndService;
use App\WorkerService;
use App\WorkerServiceCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class RegisterController extends Controller
{
    //Customer register get from by default register

    //Submit customer register
    public function submitCustomerRegister(Request $request){
        $request->validate([
            'profilePicture'     => 'required|image|max:5000',
            'userName'  => 'required|string|max:20|unique:users,user_name',
            'fullName'  => 'required|string|max:50',
            'phone'     => 'required|string|max:16|min:11|unique:users',
            'gender'    => 'required|string|max:10',
            'password'  => 'required|min:6|max:50|confirmed',
            'district'   => 'required|exists:districts,id',
            'upazila'   => 'required|integer|exists:upazilas,id',
            'referralCode'  => 'nullable|exists:referrals,own',
        ]);

        if ($request->input('password') != $request->input('password_confirmation')){
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

        //Rating
        $rating = new Rating();
        $rating->user_id  = $customer->id;
        $rating->save();

        //Balance
        $rating = new Balance();
        $rating->user_id  = $customer->id;
        $rating->save();

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


    //getWorkerRegisterForm
    public function getWorkerRegisterForm(){
        $setting = Setting::find(1);
        $districts = District::all();
        $categories= WorkerServiceCategory::all();
        return view('auth.worker-register',compact('setting', 'districts', 'categories'));
    }

    //Submit worker register
    public function submitWorkerRegister(Request $request){


        $request->validate([
            'profilePicture'=> 'required|image|max:5000',
            'userName'      => 'required|string|max:20|unique:users,user_name',
            'fullName'      => 'required|string|max:50',
            'phone'         => 'required|string|max:16|min:11|unique:users',
            'gender'        => 'required|string|max:10',
            'password'      => 'required|min:6|max:50|confirmed',
            'district'      => 'required|exists:districts,id',
            'upazila'       => 'required|integer|exists:upazilas,id',

            'nidNumber'     => 'required|unique:nids,number',
            'nidFrontImage' => 'required|image',
            'nidBackImage'  => 'required|image',
            'services'      => 'required',

            'referralCode'  => 'nullable|exists:referrals,own',
        ]);

        /*
         * Custom password check
         */
        if ($request->input('password') != $request->input('password_confirmation')){
            return response()->json([
                'type' => 'warning',
                'message' => 'Password not match',
            ]);
        }
        /**
         * Custom service id check
         */
        foreach(explode(",",$request->input('services')) as $service_id){
            if(!WorkerService::where('id', $service_id)->exists()) {
                return response()->json([
                    'type' => 'warning',
                    'message' => 'Invalid services',
                ]);
            }
        }

        /**
         * Worker store with basic information
         * */

        $worker = new User();
        $worker->role         =   'worker';
        $worker->full_name    =   $request->input('fullName');
        $worker->user_name    =   $request->input('userName');
        $worker->phone        =   $request->input('phone');
        $worker->gender       =   $request->input('gender');
        $worker->upazila_id   =   $request->input('upazila');
        $worker->password     =   Hash::make($request->input('password'));

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
            $worker->image    = $image_name;
        }
        $worker->save();

        /**
         * +Referral
         * Referral own ID generate & referral by code store in refferal table
         * */

        // Need more generate referral code max -1 10 laks
        do {
            $referral_code = mt_rand( 000001, 999999 );
        } while ( Referral::where( 'own', $referral_code )->exists() );
        $referral = new Referral();
        $referral->user_id  = $worker->id;
        $referral->own      = $referral_code;
        $referral->by       = $request->input('referralCode');
        $referral->save();

        /**
         * +NID
         * NID number, front image, back image store in NID table
         * */

        //NID store
        $nid = new Nid();
        $nid->user_id   = $worker->id;
        $nid->number    = $request->input('nidNumber');
        //NID Front
        if($request->hasFile('nidFrontImage')){
            $image              = $request->file('nidFrontImage');
            $OriginalExtension  = $image->getClientOriginalExtension();
            $image_name         =$request->input('userName').'-nid-front-'. Carbon::now()->format('d-m-Y H-i-s') .'.'. $OriginalExtension;
            $destinationPath    = ('uploads/images/nid');
            $resize_image       = Image::make($image->getRealPath());
            $resize_image->resize(500, 500, function($constraint){
                $constraint->aspectRatio();
            });
            $resize_image->save($destinationPath . '/' . $image_name);
            $nid->front_image    = $image_name;
        }
        //NID Back
        if($request->hasFile('nidBackImage')){
            $image              = $request->file('nidBackImage');
            $OriginalExtension  = $image->getClientOriginalExtension();
            $image_name         =$request->input('userName').'-nid-back-'. Carbon::now()->format('d-m-Y H-i-s') .'.'. $OriginalExtension;
            $destinationPath    = ('uploads/images/nid');
            $resize_image       = Image::make($image->getRealPath());
            $resize_image->resize(500, 500, function($constraint){
                $constraint->aspectRatio();
            });
            $resize_image->save($destinationPath . '/' . $image_name);
            $nid->back_image    = $image_name;
        }
        $nid->save();

        /**
         * +Services
         * Worker ID & Service ID linked store in WorkerAndService Table
         * */

        foreach(explode(",",$request->input('services')) as $service_id){
            $service = new WorkerAndService();
            $service->worker_id    = $worker->id;
            $service->service_id   = $service_id;
            $service->save();
        }

        //Rating
        $rating = new Rating();
        $rating->user_id  = $worker->id;
        $rating->save();

        //Balance
        $rating = new Balance();
        $rating->user_id  = $worker->id;
        $rating->save();

        /**
         * After all success auto login
         * */

        if(Auth::attempt(['phone' => $worker->phone, 'password' => $request->input('password'), 'status' => 1])) {
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


    //getMembershipRegisterForm
    public function getMembershipRegisterForm(){
        $setting = Setting::find(1);
        $districts = District::all();
        $categories= MembershipServiceCategory::all();
        return view('auth.membership-register',compact('setting', 'districts', 'categories'));
    }

    //Submit membership register
    public function submitMembershipRegister(Request $request){
        $request->validate([
            'profilePicture'=> 'required|image|max:5000',
            'userName'      => 'required|string|max:20|unique:users,user_name',
            'fullName'      => 'required|string|max:50',
            'phone'         => 'required|string|max:16|min:11|unique:users',
            'gender'        => 'required|string|max:10',
            'password'      => 'required|min:6|max:50|confirmed',
            'district'      => 'required|exists:districts,id',
            'upazila'       => 'required|integer|exists:upazilas,id',

            'nidNumber'     => 'required|unique:nids,number',
            'nidFrontImage' => 'required|image',
            'nidBackImage'  => 'required|image',
            'services'      => 'required',

            'referralCode'  => 'nullable|exists:referrals,own',
        ]);

        /*
         * Custom password check
         */
        if ($request->input('password') != $request->input('password_confirmation')){
            return response()->json([
                'type' => 'warning',
                'message' => 'Password not match',
            ]);
        }
        /**
         * Custom service id check
         */
        foreach(explode(",",$request->input('services')) as $service_id){
            if(!MembershipService::where('id', $service_id)->exists()) {
                return response()->json([
                    'type' => 'warning',
                    'message' => 'Invalid services',
                ]);
            }
        }

        /**
         * membership store with basic information
         * */

        $membership = new User();
        $membership->role         =   'membership';
        $membership->full_name    =   $request->input('fullName');
        $membership->user_name    =   $request->input('userName');
        $membership->phone        =   $request->input('phone');
        $membership->gender       =   $request->input('gender');
        $membership->upazila_id   =   $request->input('upazila');
        $membership->password     =   Hash::make($request->input('password'));

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
            $membership->image    = $image_name;
        }
        $membership->save();

        /**
         * +Referral
         * Referral own ID generate & referral by code store in refferal table
         * */

        // Need more generate referral code max -1 10 laks
        do {
            $referral_code = mt_rand( 000001, 999999 );
        } while ( Referral::where( 'own', $referral_code )->exists() );
        $referral = new Referral();
        $referral->user_id  = $membership->id;
        $referral->own      = $referral_code;
        $referral->by       = $request->input('referralCode');
        $referral->save();

        /**
         * +NID
         * NID number, front image, back image store in NID table
         * */

        //NID store
        $nid = new Nid();
        $nid->user_id   = $membership->id;
        $nid->number    = $request->input('nidNumber');
        //NID Front
        if($request->hasFile('nidFrontImage')){
            $image              = $request->file('nidFrontImage');
            $OriginalExtension  = $image->getClientOriginalExtension();
            $image_name         =$request->input('userName').'-nid-front-'. Carbon::now()->format('d-m-Y H-i-s') .'.'. $OriginalExtension;
            $destinationPath    = ('uploads/images/nid');
            $resize_image       = Image::make($image->getRealPath());
            $resize_image->resize(500, 500, function($constraint){
                $constraint->aspectRatio();
            });
            $resize_image->save($destinationPath . '/' . $image_name);
            $nid->front_image    = $image_name;
        }
        //NID Back
        if($request->hasFile('nidBackImage')){
            $image              = $request->file('nidBackImage');
            $OriginalExtension  = $image->getClientOriginalExtension();
            $image_name         =$request->input('userName').'-nid-back-'. Carbon::now()->format('d-m-Y H-i-s') .'.'. $OriginalExtension;
            $destinationPath    = ('uploads/images/nid');
            $resize_image       = Image::make($image->getRealPath());
            $resize_image->resize(500, 500, function($constraint){
                $constraint->aspectRatio();
            });
            $resize_image->save($destinationPath . '/' . $image_name);
            $nid->back_image    = $image_name;
        }
        $nid->save();

        /**
         * +Services
         * Worker ID & Service ID linked store in WorkerAndService Table
         * */

        foreach(explode(",",$request->input('services')) as $service_id){
            $service = new MembershipAndService();
            $service->membership_id    = $membership->id;
            $service->service_id   = $service_id;
            $service->save();
        }

        //Rating
        $rating = new Rating();
        $rating->user_id  = $membership->id;
        $rating->save();

        //Balance
        $rating = new Balance();
        $rating->user_id  = $membership->id;
        $rating->save();

        /**
         * After all success auto login
         * */

        if(Auth::attempt(['phone' => $membership->phone, 'password' => $request->input('password'), 'status' => 1])) {
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
