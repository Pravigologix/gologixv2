<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewPayments;

use DB;
use Auth;

class ExtraAmountController extends Controller
{
    public function extramAmountadd(Request $request){
        $user= Auth::user();  
        $trans_id=(string)$request->input( 'pay_price' ).(string)$userdetails->id.'2022'.$request->input( 'date' );

        if($userdetails->id==$request->input('user_id')){
       
        $payment = DB::table( 'payments' )->insert( [
            'pay_price'=>$request->input( 'pay_price' ),
            'pay_user_id'=>$userdetails->id,
            'pay_description'=>$request->input( 'pay_description' ),
            'pay_transaction_id'=>$trans_id,
            'pay_paysta_status_id'=>$request->input( 'pay_paysta_status_id' ),
            'pay_method'=>$request->input( 'pay_method' ),
           
            
        ] );

        if($payment){

        $paymentid=DB::table('payments')
        ->where('pay_user_id','=',$request->input('user_id'),)
        ->where('pay_transaction_id','=', $trans_id)
           ->orderBy('id', 'asc')
        ->first('id');

        
        
        $payid=$paymentid->id;



      $new_payments= new  NewPayments;

      $new_payments->payment_id=$payid;
      $new_payments->user_id=$request->input('user_id');
      $new_payments->booking_id=$request->input('booking_id');
      $new_payments->save();

      

        return response()->json([
            "payment_id"=>$payid,
            'status'=>'Sucess','message'=>'Extra_amount updated'],200);}else{

            return response()->json(['status'=>'falied','message'=>'Extra_amount not added'],303);

        }}
        return response()->json(['status'=>'falied','message'=>'Invalid User'],412);


    }
    public function extraAmountupdate(Request $request){
        $user= Auth::user();  
        $data=DB::table('payments')
        ->where('payments.pay_user_id','=',$user->id)
        ->where('payments.id','=',$request->input('payment_id'))
      
        ->update([

            'pay_transaction_id'=>$request->input('trans_id'),
            'pay_paysta_status_id'=>$request->input('pay_paysta_status_id'),

        ]);

        return response()->json(['status'=>'Sucess','message'=>'Extra_amount updated'],200);

    }

    public function getextraAmount(Request $request){
        $user= Auth::user();  
        $data=NewPayments::where('user_id','=',$request->input('user_id'))
        ->where('booking_id','=',$request->input('booking_id'))
        ->with('new_payment')
        ->get();

        return response()->json(['status'=>'Sucess','Extra datails'=>$data],200);

    }

}
