<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
   public function showOffer(){
       $setting = Setting::find(1);
       return view('admin.setting.offer', compact('setting'));
   }

   public function updateOffer(Request $request){
       $request->validate([
           'english_description' => 'required|min:15',
           'bengali_description' => 'required|min:15'
       ]);
       $setting = Setting::find(1);
       $setting->en_offer = $request->input('english_description');
       $setting->bn_offer = $request->input('bengali_description');
       $setting->save();
       return $setting;
   }

   public function showReferralIncome(){
       $setting = Setting::find(1);
       return view('admin.setting.referral-income-system', compact('setting'));
   }

   public function updateReferralIncome(Request $request){
       $request->validate([
           'english_description' => 'required|min:10',
           'bengali_description' => 'required|min:10'
       ]);
       $setting = Setting::find(1);
       $setting->en_referral_income_system = $request->input('english_description');
       $setting->bn_referral_income_system = $request->input('bengali_description');
       $setting->save();
       return $setting;
   }

   public function showVideoTraining(){
       $setting = Setting::find(1);
       return view('admin.setting.video-training', compact('setting'));
   }

   public function updateVideoTraining(Request $request){
       $request->validate([
           'customer_video_training_url' => 'required|min:3',
           'worker_video_training_url' => 'required|min:3',
           'membership_video_training_url' => 'required|min:3'
       ]);
       $setting = Setting::find(1);
       $setting->customer_video_training_url = $request->input('customer_video_training_url');
       $setting->worker_video_training_url = $request->input('worker_video_training_url');
       $setting->membership_video_training_url = $request->input('membership_video_training_url');
       $setting->save();
       return $setting;
   }

   public function showHelpLine(){
       $setting = Setting::find(1);
       return view('admin.setting.help-line', compact('setting'));
   }

   public function updateHelpLine(Request $request){
       $request->validate([
           'english_description' => 'required|min:10',
           'bengali_description' => 'required|min:10'
       ]);
       $setting = Setting::find(1);
       $setting->en_help_line = $request->input('english_description');
       $setting->bn_help_line = $request->input('bengali_description');
       $setting->save();
       return $setting;
   }


   public function showAbout(){
       $setting = Setting::find(1);
       return view('admin.setting.about', compact('setting'));
   }

   public function updateAbout(Request $request){
       $request->validate([
           'english_description' => 'required|min:10',
           'bengali_description' => 'required|min:10'
       ]);
       $setting = Setting::find(1);
       $setting->en_about = $request->input('english_description');
       $setting->bn_about = $request->input('bengali_description');
       $setting->save();
       return $setting;
   }

   public function showFaq(){
       $setting = Setting::find(1);
       return view('admin.setting.faq', compact('setting'));
   }

    public function updateFaq(Request $request){
        $request->validate([
            'english_description' => 'required|min:10',
            'bengali_description' => 'required|min:10'
        ]);
        $setting = Setting::find(1);
        $setting->en_faq = $request->input('english_description');
        $setting->bn_faq = $request->input('bengali_description');
        $setting->save();
        return $setting;
    }

   public function showTermsAndCondition(){
       $setting = Setting::find(1);
       return view('admin.setting.terms-and-condition', compact('setting'));
   }

    public function updateTermsAndCondition(Request $request){
        $request->validate([
            'english_description' => 'required|min:10',
            'bengali_description' => 'required|min:10'
        ]);
        $setting = Setting::find(1);
        $setting->en_terms_and_condition = $request->input('english_description');
        $setting->bn_terms_and_condition = $request->input('bengali_description');
        $setting->save();
        return $setting;
    }

   public function showPrivacyPolicy(){
       $setting = Setting::find(1);
       return view('admin.setting.privacy-policy', compact('setting'));
   }

    public function updatePrivacyPolicy(Request $request){
        $request->validate([
            'english_description' => 'required|min:10',
            'bengali_description' => 'required|min:10'
        ]);
        $setting = Setting::find(1);
        $setting->en_privacy_policy = $request->input('english_description');
        $setting->bn_privacy_policy = $request->input('bengali_description');
        $setting->save();
        return $setting;
    }

    public function showGeneralInformation(){
       $setting = Setting::find(1);
       return view('admin.setting.general-information', compact('setting'));
   }

    public function updateGeneralInformation(Request $request){
        $request->validate([
            'english_description' => 'required|min:10',
            'bengali_description' => 'required|min:10'
        ]);
        $setting = Setting::find(1);
        $setting->en_privacy_policy = $request->input('english_description');
        $setting->bn_privacy_policy = $request->input('bengali_description');
        $setting->save();
        return $setting;
    }
}
