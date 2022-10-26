<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;
use DB;
use Auth;


class AllUserBookingDetails extends Controller
{
    public function allUserBookingDetails(Request $request){
     $user=Auth::User();
    $users=DB::table('users')
    ->where('users.id','=',$user->id)
    ->where('is_admin','=',2)
    ->select('users.is_admin')
    ->get();
    
   if($users);
{
        $details=DB::table('book_parking')
        ->join('users','book_parking.user_id','=','users.id')
        ->join('addresses','book_parking.address_id','=','addresses.id')
        ->join('payments_status','book_parking.payment_status','=','payments_status.id')
        ->join('payments','book_parking.payment_id','=','payments.id')
        ->select('users.id as user_id','users.name','book_parking.id as booking_id','paking_type','parking_amt','parking_status','payment_id','start_date','end_date','is_cacnceled','parking_slot_number','qrcode','addresses.add_description','add_latitude','add_longitude','payments_status.paysta_status_name')
        ->get();

        return response(["All booking_deatils"=>$details,200]);
    }

    
}
}