<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

use App\Http\Controllers\API\User\cloudparking\userStatus;

use QrCode;



class qrcodeController extends Controller
{
    
    public function qrCode(Request $request){
        $data=DB::table('users')->where('id','=',$request->input('user_id'))->get();

       $d=QrCode::generate($data,public_path('/images'));
       return response()->json( ["qr_image_url"=>'/images'],200);



     //   $d=QrCode::generate($data,public_path('/images'));
       

       // return response()->json( ["qr_image_url"=>'/images'],200);

}
}
