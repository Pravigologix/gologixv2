<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookParkingModel;
use DB;
use Auth;

class BookingDetailsController extends Controller
{
    public function bookingDetails(Request $request){
        $user= Auth::user(); 

        $details=BookParkingModel::where('book_parking.user_id','=',$user->id)->
        with('user_details')->
        with('address_details')
        ->with('booking_payment_details')
        ->with('parking_charge_details')
        ->with('parking_slot_address_details')

        
      
        ->get();
        return response(["all_booking_deatils"=>$details],200);

    }
}
