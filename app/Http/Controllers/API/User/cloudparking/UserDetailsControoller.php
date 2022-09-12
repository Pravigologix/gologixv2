<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class UserDetailsControoller extends Controller
{
    public function users(Request $request){
        $user = Auth::user();
        if($user!=null){
            $data=DB::table('book_parking')
            ->leftjoin('users','book_parking.user_id','=','users.id')
            ->leftjoin('addresses','book_parking.address_id','=','addresses.id')
            ->leftjoin('payments','book_parking.payment_id','=','payments.id')
           ->select('users.name','users.id','users.phonenumber','email','add_city_id','add_pincode','add_description','add_address','book_parking.paking_type','parking_amt','payment_status','start_date','end_date','payments.pay_price','pay_description','pay_transaction_id')
            ->get();
            return response()->json(["User_parking_details"=>$data],200);

}
}
}