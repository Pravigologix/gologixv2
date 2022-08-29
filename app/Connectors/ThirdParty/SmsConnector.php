<?php

namespace App\Connectors\ThirdParty;

use App\Connectors\Interfaces\ThirdParty\SmsConnectorInterface;

/**
 * Class SmsConnector
 * @package App\Connectors\ThirdParty
 */
class SmsConnector implements SmsConnectorInterface
{

    public function sendSms($mobileNo, $text){
    	try {

    		$phone_no = $mobileNo;
            $msg = urlencode($text);
     
            $ch=  curl_init("https://smshorizon.co.in/api/sendsms.php?user=gologix&apikey=brpBAnzGAiY7JqFCJSZY&mobile=".$phone_no."&message=".$msg."&senderid=GOLOGI&type=txt&tid=1207163902893789527");
     
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);

            // dd($output);

        
            curl_close($ch);


    		return true;

    	} catch (Exception $e) {

            return false;

        }
    }

}
