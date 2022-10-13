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

        $details=DB::table('book_parking')
        ->join('users','book_parking.user_id','=','users.id')
        ->join('addresses','book_parking.address_id','=','addresses.id')
        ->join('payments','book_parking.payment_id','=','payments.id')
        ->where('book_parking.user_id','=',$user->id)
        ->select('users.id as user_id','users.name','users.email','users.phonenumber',
        'book_parking.id as book_parking_id','book_parking.paking_type','parking_amt','payment_status',
        'parking_status','start_date','end_date','is_cacnceled','parking_slot_number','qrcode',
        'addresses.id as address_id','add_description','add_address','add_city_id','add_pincode',
        'add_latitude','add_longitude','payments.id as payment_id','payments.pay_price',
        'payments.pay_description','payments.pay_transaction_id','payments.pay_paysta_status_id',
        'payments.pay_method')
        ->get();
        return $details;

    }
}
