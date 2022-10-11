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
        if($user->is_admin==3){
        //dd($user->id);
        $details=DB::table('payments')
        ->where('payments.pay_user_id','=',$user->id)
        ->select('payments.id','payments.pay_price','payments.pay_description','pay_user_id','pay_transaction_id','pay_paysta_status_id','pay_method')
        ->get();
        return response()->json( [ 'User transaction details'=>$details ],200 );
        }
        return response()->json( [ 'User transaction details'=>"your not customer" ],300);
 
    }
}
