<?php
use Illuminate\Support\Facades\Session;
use Stichoza\GoogleTranslate\GoogleTranslate;

if (!function_exists('random_code')){

    /*function translate($text){
        $tr = new GoogleTranslate(Session::get('language'));
        return $tr->translate($text);
    }*/

    function setting($kay){
        $setting = \App\Setting::find(1)->$kay;
        if ($setting){
            return $setting;
        }else{
            return false;
        }
    }
}

?>
