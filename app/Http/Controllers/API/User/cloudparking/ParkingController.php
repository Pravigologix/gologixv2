<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use DB;


class ParkingController extends Controller
{
     public function getalladdress( Request $request ) {
       
        $data = DB::table( 'addresses' )
            ->leftjoin('add_parking_slots','addresses.id','=','add_parking_slots.address_id')
             ->leftjoin('parking_charges','add_parking_slots.id','=','parking_charges.add_praking_slot_id')
            ->where('parking_charges.is_active','0')
            ->where('addresses.add_isactive','0')->select(
            'addresses.add_description','addresses.add_address','addresses.add_city_id','addresses.add_pincode','addresses.add_latitude','addresses.longitude',
            'add_parking_slots.id as slot_id','add_parking_slots.parking_type','add_parking_slots.parking_no','add_parking_slots.starts_at','add_parking_slots.ends_at','add_parking_slots.parking_slots',
        'parking_charges.*'
        )
        
        
      
        ->get();

        return response()->json( [ 'User_parking_details'=>$data ], 200 );
    }
    
    
    
   
}
