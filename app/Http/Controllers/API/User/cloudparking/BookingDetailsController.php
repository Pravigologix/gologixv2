<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookParkingModel;
use App\Models\NewPayments;
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
        ->with('all_parking_charge_details')
        ->with('parking_slot_address_details')
        
      
        ->get();


        $addtional_payments=NewPayments::where('user_id','=',$user->id)
       
        ->with('new_payment')
        ->get();
        return response(["all_booking_deatils"=>$details,"addtional_payments"=>$addtional_payments],200);

    }
}
