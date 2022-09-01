<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    public function index(){
        
        $userdetails=Auth::user();
        /*
     //get data from database    
$users = DB::table('addresses')->select('id')->where('add_user_id','=',$userdetails->id)
->get();
  */
  //
$user=DB::table('users')->leftJoin('addresses', 'addresses.add_user_id', '=', 'users.id')->get();
return $user;
}
}
