<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use DB;

//class ParkingController extends Controller {
 //   public function index() {

  //      $userdetails = Auth::user();

//<<<<<<< ashwini
class ParkingController extends Controller
{
    public function parkingAddress(){
        
        $userdetails=Auth::user();
//=======
        //$user = DB::table( 'addresses' )->leftJoin( 'users', 'addresses.add_user_id', '=', 'users.id' )->select( 'addresses.add_description', 'add_address', 'add_city_id', 'add_pincode', 'add_latitude', 'add_longitude', 'add_user_id', 'add_isactive', 'add_isdeleted' )->where( 'addresses.add_isactive', '=', 1 )->where( 'addresses.add_isdeleted', '=', 0 )->where( 'users.user_role_id', '=', 1 )->get();
//>>>>>>> main

        $user = DB::table( 'users' )->leftJoin( 'addresses', 'addresses.add_user_id', '=', 'users.id' )->get();

        //$user = DB::table( 'users' )->leftJoin( 'addresses', 'addresses.add_user_id', '=', 'users.id' )->get();

        $user = DB::table( 'addresses' )->leftJoin( 'users', 'addresses.add_user_id', '=', 'users.id' )->select( 'addresses.add_description', 'add_address', 'add_city_id', 'add_pincode', 'add_latitude', 'add_longitude', 'add_user_id', 'add_isactive', 'add_isdeleted' )->where( 'addresses.add_isactive', '=', 1 )->where( 'addresses.add_isdeleted', '=', 0 )->where( 'users.user_role_id', '=', 1 )->get();

//<<<<<<< ashwini
$user=DB::table('users')
->leftJoin('addresses', 'addresses.add_user_id', '=', 'users.id')
->select('addresses.add_description','add_address','add_city_id','add_pincode','add_latitude','add_longitude','add_user_id','add_isactive','add_isdeleted')
->where('addresses.add_isactive','=',1)
->where('addresses.add_isdeleted','=',0)
->where('users.is_admin','=',2)
->get();

return $user;
}
     public function getallparkingAddress(){
         $address=DB::table('addresses')->where('is_cloud_parking','=','1')->get();
         
         return response()->json(["parkingaddress"=>$$address],200);
     }
    
    
    
//=======
 //       return $user;
 //   }
//>>>>>>> main
}
