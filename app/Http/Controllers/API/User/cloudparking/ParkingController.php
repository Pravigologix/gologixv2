<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use DB;


class ParkingController extends Controller
{
     public function getalladdress( Request $request ) {
       
        $data = DB::table( 'address' )
        
        
      
        ->get();

        return response()->json( [ 'User_parking_details'=>$data ], 200 );
    }
    
    
    
   
}
