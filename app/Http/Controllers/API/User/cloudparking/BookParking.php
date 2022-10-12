<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class BookParking extends Controller
{
    public function bookpakingbyuser(Request $request) {
        
        $userdetails=Auth::user();
        
         $trans_id=(string)$request->input( 'pay_price' ).(string)$userdetails->id.'2022'.$request->input( 'date' );
       
        $payment = DB::table( 'payments' )->insert( [
            'pay_price'=>$request->input( 'pay_price' ),
            'pay_user_id'=>$userdetails->id,
            'pay_description'=>$request->input( 'pay_description' ),
            'pay_transaction_id'=>$trans_id,
            'pay_paysta_status_id'=>$request->input( 'pay_paysta_status_id' ),
            'pay_method'=>$request->input( 'pay_method' ),
           
        ] );

        $paymentid=DB::table('payments')
        ->where('pay_user_id','=',$request->input('user_id'),)
        ->where('pay_transaction_id','=', $trans_id)
        ->get('id');

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
            'payment_id'=>(string)$paymentid,
            'start_date'=>$request->input('start_date'),
            'is_cacnceled'=>$request->input('is_canceled'),
            'parking_slot_number'=>$slot_no,
            "end_date"=>'',
        ]);
          
           $bookingid= DB::table('book_parking')->where('paking_type','=',$request->input('paking_type'))
               ->where('payment_id','=',(string)$paymentid)
                ->where('parking_status','=',$request->input('parking_status'),)
               ->where( 'address_id','=',$request->input('address_id'))->get('id');

        return response()->json(['message'=>'Booking initaited',
                                  'payment_id'=>$paymentid,
          "booking_id"=>$bookingid,
   
   
     
        'slot_no'=>$slot_no,


        'status'=>1,'user_id'=>$request->input('user_id')],200);
       
      }
      return response()->json([
        'status'=>0,
         
        'message'=>'Bokking failed try again'
      ]);

    }


    public function updatebookpakingbyuser(Request $request) {
         $userdetails=Auth::user();
        
        
           $payment = DB::table( 'payments' )->where('id','=',$request->input('payment_id'))
                 ->update( [
            'pay_transaction_id'=>$request->input( 'trnas_id' ),
            'pay_paysta_status_id'=>$request->input( 'pay_paysta_status_id' ),
            'pay_method'=>$request->input( 'pay_method' ),
           
        ] );

      $user_bokking= DB::table('book_parking')
      ->where('user_id','=',$request->input('user_id'))
      ->where('id','=',$request->input('id'))
      ->where('address_id','=',$request->input('address_id'))


      
      ->update([
        'paking_type'=>$request->input('paking_type'),
          'parking_slot_number'=>$request->input('slot_no'),
     
        'payment_status'=>$request->input('payment_status'),
        'parking_status'=>$request->input('parking_status'),
        
        
       
    ]);
        
        if($request->input('payment_status')==4){
            
             return response()->json(['message'=>'Booking Canceled', 'status'=>0],303);
            
            
        }

    return response()->json(['message'=>'Booking Confired',


 
  


    'status'=>1],200);



    }
    
    

  
}
