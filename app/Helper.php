<?php
use Illuminate\Support\Facades\Session;
use Stichoza\GoogleTranslate\GoogleTranslate;

if (!function_exists('random_code')){
    function translate($text){
        $tr = new GoogleTranslate(Session::get('language'));
        return $tr->translate($text);
    }
}

?>
