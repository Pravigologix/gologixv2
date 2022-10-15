<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookParkingModel;
use DB;
use Auth;

class TimeController extends Controller
{
    
    public function updateTime(Request $req){
        $user=Auth::user();
       $time=DB::table('book_parking')
       ->where('book_parking.user_id','=','$user->id')
       ->where('book_parking.id','=',$req->input('id'))
       ->update([
            "parking_status": $req->input('parking_status'),
           'start_date'=>$req->input('start_date'),
           'end_date'=>$req->input('end_date'),
           'parking_amt'=>$req->input('parking_amt')]);
       
       return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);

    }
}
