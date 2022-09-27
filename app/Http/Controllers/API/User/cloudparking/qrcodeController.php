<?php

namespace App\Http\Controllers\API\User\cloudparking;
use App\Models\BookParkingModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

use App\Http\Controllers\API\User\cloudparking\userStatus;

use QrCode;



class qrcodeController extends Controller
{

    public function addqrCode(Request $request){
      $userdetails=Auth::user(); 
     // dd($userdetails->id);
        $data=DB::table('book_parking')
        ->join('users','book_parking.user_id','=','users.id')
        ->join('payments_status','book_parking.payment_status','payments_status.id')
        ->where('book_parking.id','=',$userdetails->id)


        ->select('users.id','users.name','book_parking.id','book_parking.paking_type','book_parking.parking_amt','book_parking.parking_slot_number','book_parking.start_date','book_parking.end_date','book_parking.payment_status','payments_status.paysta_status_name')->get();

        $files=QrCode::size(100)->generate($data);
         //$qrcode=env('APP_URL').'/images'.'/qrcode'.'/'.$files; 

        //  $userdetails=Auth::user(); 
         //dd($userdetails->id);

         $userdetails=new BookParkingModel;
         $userdetails->paking_type=$request->input('paking_type');
         $userdetails->parking_amt=$request->input('parking_amt');
         $userdetails->user_id =(int)$userdetails->id;
         $userdetails->address_id =$request->input('address_id');
         $userdetails->payment_status =$request->input('payment_status');
         $userdetails->parking_status =$request->input('parking_status');
         $userdetails->payment_id =$request->input('payment_id');
         $userdetails->start_date =$request->input('start_date');
         $userdetails->	end_date =$request->input('	end_date');
         $userdetails->parking_slot_number =$request->input('parking_slot_number');
         $userdetails->qrcode=$files;
         $userdetails-> save();
         return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);


return $qrcode;

}

public function getqrCode(Request $request){

  $userdetails=Auth::user(); 
  $data=DB::table('book_parking')
  ->join('users','book_parking.user_id','=','users.id')
  ->join('payments_status','book_parking.payment_status','payments_status.id')
  ->where('book_parking.user_id','=',$userdetails->id)


  ->select('users.id','users.name','book_parking.id','book_parking.paking_type','book_parking.parking_amt','book_parking.parking_slot_number','book_parking.start_date','book_parking.end_date','book_parking.payment_status','payments_status.paysta_status_name','book_parking.qrcode')->get();

  return $data;
}
}