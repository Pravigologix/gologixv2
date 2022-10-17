<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class ExtraAmountController extends Controller
{
    public function extramAmountUpdate(Request $request){
        $user= Auth::user();  
        $data=DB::table('payments')
        ->where('payments.pay_user_id','=',$user->id)
        ->where('payments.id','=',$request->input('id'))
        ->update(['extra_amt'=>$request->input('extra_amt')]);

        return response()->json(['status'=>'Sucess','message'=>'Extra_amount updated'],200);

    }
    public function getExtraAmount(Request $request){
        $user= Auth::user();  
        $data=DB::table('payments')
        ->where('payments.pay_user_id','=',$user->id)
        ->where('payments.id','=',$request->input('id'))
        ->select('id','extra_amt')
        ->get();

        return response()->json(['extra amount'=>$data]);

    }

}
