<?php

namespace App;




use Illuminate\Support\Str;

class SmsSender
{
    public function smsSender($to, $message)
    {
        //$to = "01304734623";
        $token = "ab5821e83a99eb9ec4774c962cb768a0";
        //$message = "Test SMS From Using API";

        $url = "http://api.greenweb.com.bd/api.php";

        $data= array(
            'to'=>"$to",
            'message'=>"$message",
            'token'=>"$token"
        ); // Add parameters in key value
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);

        //Result
        return $smsresult;
        //Error Display
        //echo curl_error($ch);

    }

}
