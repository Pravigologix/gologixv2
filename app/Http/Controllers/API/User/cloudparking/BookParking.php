<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class BookParking extends Controller
{
    public function bookpakingbyuser(Request $request) {

        $booking_count=DB::table('book_parking')
        ->where('address_id','=',$request->input('address_id'))->count();
        $booked_slot_no=DB::table('book_parking')
        ->where('address_id','=',$request->input('address_id'))->select('parking_slot_number','user_id')
        ->get();

        $total_count=DB::table('add_praking_slots')
        ->where('parking_type','=',$request->input('paking_type'))
        ->where('address_id','=',$request->input('address_id'))
        ->select('parking_slots')
        ->get();
        $slots=$total_count->map(function($item, $key) {
            return 
                $item->parking_slots  
            ;
        });

     $book_slot_id=   $booked_slot_no->map(function($item,$key){
            return $item->parking_slot_number;
        });



        $arraylist=json_decode($slots[0]);

       
      $slot_no= rand(1,100);

      $compare=($booking_count<$slots[0]);


   


      if(!$book_slot_id->contains($slot_no)&&$compare){
        $user_bokking= DB::table('book_parking')->insert([
            'paking_type'=>$request->input('paking_type'),
            'parking_amt'=>$request->input('parking_amt'),
            'user_id'=>$request->input('user_id'),
            'address_id'=>$request->input('address_id'),
            'payment_status'=>$request->input('payment_status'),
            'parking_status'=>$request->input('parking_status'),
            'payment_id'=>$request->input('payment_id'),
            'start_date'=>$request->input('start_date'),
            'is_cacnceled'=>$request->input('is_canceled'),
            'parking_slot_number'=>$slot_no,
            "end_date"=>'',
        ]);

        return response()->json(['message'=>'Booking Confired',
   
   
     
        'slot_no'=>$slot_no,


        'status'=>1,'user_id'=>$request->input('user_id')],200);
       
      }
      return response()->json([
        'status'=>0,
        'message'=>'Bokking failed try again'
      ]);

    }


    public function updatebookpakingbyuser(Request $request) {

      $user_bokking= DB::table('book_parking')
      ->where('user_id','=',$request->input('user_id'))
      ->where('id','=',$request->input('id'))
      ->where('address_id','=',$request->input('address_id'))


      
      ->update([
        'paking_type'=>$request->input('paking_type'),
        'parking_amt'=>$request->input('parking_amt'),
        'payment_status'=>$request->input('payment_status'),
        'parking_status'=>$request->input('parking_status'),
        'payment_id'=>$request->input('payment_id'),
        'start_date'=>$request->input('start_date'),
        'is_cacnceled'=>$request->input('is_canceled'),
        "end_date"=>$request->input('end_date')
    ]);

    return response()->json(['message'=>'Booking Confired',


 
    'slot_no'=>$slot_no,


    'status'=>1,'user_id'=>$request->input('user_id')],200);



    }

  
}