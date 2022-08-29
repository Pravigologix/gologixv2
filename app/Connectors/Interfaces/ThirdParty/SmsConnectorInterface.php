<?php

namespace App\Connectors\Interfaces\ThirdParty;


interface SmsConnectorInterface
{

	public function sendSms($mobile_no, $text);

}