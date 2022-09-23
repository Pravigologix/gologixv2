<?php
// namespace App\Modules\Utils;
namespace App\Http\Controllers\Utils\Utils;


use Validator;

class Utils
{
    public function __construct() {

    }

    public static function validateInputs(&$inputs, $rules) {

    	$validatedData = Validator::make($inputs, $rules);

        if($validatedData->fails()) {
            return [
                'success' => false,
                'message' => $validatedData->errors()->all()
            ];
        }
        return ['success' => true];
    }

    public static function generateOtp() {
        return rand(100000, 999999);
    }

    public static function defaultResponse($outputs,$status,$message)
    {
        if($message=="") $message= $status==1?"successfull":"failed";
        if($outputs==null) $outputs=[];
        return ["body"=>$outputs,"success"=>$status, "message"=>$message];

    }



}