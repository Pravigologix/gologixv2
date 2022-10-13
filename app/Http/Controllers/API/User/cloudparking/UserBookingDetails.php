<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class UserBookingDetails extends Controller
{
    public function bookingDetails(Request $request){

    $user=Auth::user();
    //dd($user->id);
    $details=DB::table('book_parking')
    ->join('addresses','book_parking.address_id','=','addresses.id')
    ->join('add_praking_slots','addresses.id','=','add_praking_slots.address_id')
    ->join('parking_charges','add_praking_slots.id','=','parking_charges.add_praking_slot_id')
    ->join('add_praking_desc','parking_charges.add_praking_desc_id','=','add_praking_desc.id')

    ->where('book_parking.user_id','=',$user->id)
    ->select('parking_charges.id as parking_id','parking_charges.vendor_id',
    'parking_charges.parking_amt','parking_charges.add_praking_desc_id',
    'parking_charges.add_praking_slot_id','parking_charges.is_active',
    'parking_charges.is_delete','add_praking_slots.id as parking_slot_id',
    'add_praking_slots.parking_type','add_praking_slots.parking_no',
    'add_praking_slots.starts_at','add_praking_slots.ends_at',
    'add_praking_slots.parking_slots','add_praking_slots.user_id',
    'add_praking_slots.address_id','add_praking_desc.id as add_parking_desc_id',
    'add_praking_desc.timings','add_praking_desc.is_active','add_praking_desc.is_delette',
    'addresses.id as address_id','add_description','add_address','add_city_id','add_pincode',
    'add_latitude','add_longitude')

    ->get();

    return response()->json(['status'=>'Sucess','bookingDetails'=>$details],200);
    }
}
