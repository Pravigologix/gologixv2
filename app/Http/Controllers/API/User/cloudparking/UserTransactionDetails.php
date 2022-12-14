<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class UserTransactionDetails extends Controller
{
    public function getTransactionDetails(Request $request)
    {
        $user= Auth::user();  
        if($user->is_admin==0){
        //dd($user->id);
        $details=DB::table('payments')
        ->where('payments.pay_user_id','=',$user->id)
      
        ->get();
        return response()->json( [ 'User transaction details'=>$details ],200 );
        }
        return response()->json( [ 'User transaction details'=>"your not customer" ],300);
 
    }
}
