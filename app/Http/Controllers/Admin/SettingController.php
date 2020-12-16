<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class SettingController extends Controller
{
    public function showGeneralInformation(){
        return view('admin.setting.general-information');
    }

    public function updateGeneralInformation(Request $request){

        update_static_option('name', $request->input('name'));

        if($request->hasFile('logo')){
            $image             = $request->file('logo');
            $folder_path       = 'uploads/images/';
            $image_new_name    = Str::random(8).'-logo-'.Carbon::now()->format('d-m-Y H-i-s') .'.'. $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->fit(280, 84, function($constraint){
                $constraint->aspectRatio();
            })->save($folder_path.$image_new_name);
            update_static_option('logo', $folder_path.$image_new_name);
        }

        if($request->hasFile('logo_white')){
            $image             = $request->file('logo_white');
            $folder_path       = 'uploads/images/';
            $image_new_name    = Str::random(8).'-logo_white-'.Carbon::now()->format('d-m-Y H-i-s') .'.'. $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->fit(280, 84, function($constraint){
                $constraint->aspectRatio();
            })->save($folder_path.$image_new_name);
            update_static_option('logo_white', $folder_path.$image_new_name);
        }

        if($request->hasFile('header_logo')){
            $image             = $request->file('header_logo');
            $folder_path       = 'uploads/images/';
            $image_new_name    = Str::random(8).'-header_logo-'.Carbon::now()->format('d-m-Y H-i-s') .'.'. $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->fit(133, 51, function($constraint){
                $constraint->aspectRatio();
            })->save($folder_path.$image_new_name);
            update_static_option('header_logo', $folder_path.$image_new_name);
        }

        if($request->hasFile('header_logo_white')){
            $image             = $request->file('header_logo_white');
            $folder_path       = 'uploads/images/';
            $image_new_name    = Str::random(8).'-header_logo_white-'.Carbon::now()->format('d-m-Y H-i-s') .'.'. $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->fit(133, 51, function($constraint){
                $constraint->aspectRatio();
            })->save($folder_path.$image_new_name);
            update_static_option('header_logo_white', $folder_path.$image_new_name);
        }

        if($request->hasFile('fav')){
            $image             = $request->file('fav');
            $folder_path       = 'uploads/images/';
            $image_new_name    = Str::random(8).'-fav-'.Carbon::now()->format('d-m-Y H-i-s') .'.'. $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->fit(68, 68, function($constraint){
                $constraint->aspectRatio();
            })->save($folder_path.$image_new_name);
            update_static_option('fav', $folder_path.$image_new_name);
        }


        update_static_option('motto', $request->input('motto'));
        update_static_option('sms_username', $request->input('sms_username'));
        update_static_option('sms_key', $request->input('sms_key'));
        update_static_option('reset_sms_count', $request->input('reset_sms_count'));
        update_static_option('reset_sms_template', $request->input('reset_sms_template'));
        update_static_option('welcome_sms_template', $request->input('welcome_sms_template'));
        update_static_option('worker_activation_price', $request->input('worker_activation_price'));
        update_static_option('per_customer_referral_price', $request->input('per_customer_referral_price'));
        update_static_option('per_worker_referral_price', $request->input('per_worker_referral_price'));
        update_static_option('per_membership_referral_price', $request->input('per_membership_referral_price'));
        update_static_option('admin_percent_on_worker_job', $request->input('admin_percent_on_worker_job'));
        return redirect()->back();
    }
}
