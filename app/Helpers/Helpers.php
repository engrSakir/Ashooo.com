<?php

use App\StaticOption;
use Illuminate\Support\Facades\App;
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

    function current_language(){
        return App::getLocale();
    }

    function send_sms($to, $message){
        //$to = "01304734623";
        $token = setting('sms_key');
        //"ab5821e83a99eb9ec4774c962cb768a0";
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

    function set_static_option($key, $value)
    {
        if (!StaticOption::where('option_name', $key)->first()) {
            StaticOption::create([
                'option_name' => $key,
                'option_value' => $value
            ]);
            return true;
        }
        return false;
    }

    function get_static_option($key)
    {
        if (StaticOption::where('option_name', $key)->first()) {
            $return_val = StaticOption::where('option_name', $key)->first();
            return $return_val->option_value;
        }
        return null;
    }

    function update_static_option($key, $value)
    {
        if (!StaticOption::where('option_name', $key)->first()) {
            StaticOption::create([
                'option_name' => $key,
                'option_value' => $value
            ]);
            return true;
        } else {
            StaticOption::where('option_name', $key)->update([
                'option_name' => $key,
                'option_value' => $value
            ]);
            return true;
        }
        return false;
    }

    function delete_static_option($key)
    {
        StaticOption::where('option_name', $key)->delete();
        return true;
    }

    function setEnvValue(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $str .= "\n"; // In case the searched variable is in the last line without \n
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) return false;
        return true;
    }


    function sendSmtpTest($to)
    {

        $subject= 'SMTP Test';
        $message= 'SMTP working fine';
        $name = get_static_option('smtp_email_from_name');
        $from = get_static_option('smtp_email_from_email');
        $headers = "From: " . $name . " \r\n";
        $headers .= "Reply-To: <$from> \r\n";
        $headers .= "Return-Path: " . ($from) . "\r\n";;
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "X-Priority: 2\nX-MSmail-Priority: high";;
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

        if (mail($to, $subject, $message, $headers)) {
            return true;
        }else{
            return false;
        }

    }
}

?>
