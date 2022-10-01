<?php

namespace App\Http\Controllers\API\vendor\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;


class UserParkingdeatils extends Controller
{
    public function generateparkinglslotforuser(Request $request)
{ 

  

  $user= Auth::user();  



    $get_no_slot=DB::table('add_praking_slot')->select('parking_slots','id')->where('user_id','=',$user->id)->get();

    $d=$get_no_slot[0]->parking_slots;
    

    return $d;
    

  

}
}
