<?php

namespace App\Http\Controllers\API\vendor\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookParkingModel;
use DB;

class UserBookingDeatils extends Controller
{
    public function getuserdetails(Request $request){

        $bookparking=BookParkingModel::where('id',"=",$request->input('booking_id'))
        ->where('user_id','=',$request->input('user_id'))
            ->with('booking_payment_details')
              ->with('user_details')
              ->with('address_details')
             ->with('parking_charge_details')
             ->with('parking_slot_address_details')
        ->get();


        return response()->json(['user_details'=>$bookparking],200);





    }


}
