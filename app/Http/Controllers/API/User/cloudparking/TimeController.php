<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookParkingModel;
use DB;
use Auth;

class TimeController extends Controller
{
    public function time(Request $req){
        $user=Auth::user();
        $start_time=DB::table('book_parking')
        ->select('id as booking_id','user_id','start_date as start date and time',
        'end_date as end date and time','parking_amt as amount')
        ->where('user_id','=','$user->id')
        ->get();
        return response()->json(['booking details'=>$start_time],200);
    }
    public function updateTime(Request $req){
        $user=Auth::user();
       $time=DB::table('book_parking')
       ->where('book_parking.user_id','=','$user->id')
       ->where('book_parking.id','=',$req->input('id'))
       ->update(['start_date'=>$req->input('start_date'),'end_date'=>$req->input('end_date'),'parking_amt'=>$req->input('parking_amt')]);
       
       return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);

    }
}