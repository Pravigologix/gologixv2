<?php

namespace App\Http\Controllers\API\vendor\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorAccounts;
use DB;
use Auth;


class VendorAccountsController extends Controller
{

    public function addVendorAccountDetails(Request $request){
        $userdetails= Auth::user();  
        if($userdetails->is_admin==2){
            $userdetails=new VendorAccounts;
            $userdetails->vendor_id=$request->input('vendor_id');
            $userdetails->venacc_name=$request->input('venacc_name');
            $userdetails->venacc_alias =$request->input('venacc_alias ');
            $userdetails->venacc_bank_name=$request->input('venacc_bank_name');
            $userdetails->venacc_account_no=$request->input('venacc_account_no');
            $userdetails->venacc_paymet_id=$request->input('venacc_paymet_id');
            $userdetails->venacc_ifsc=$request->input('venacc_ifsc');
            $userdetails->venacc_isactive=$request->input('venacc_isactive');
            $userdetails->venacc_isdeleted=$request->input('venacc_isdeleted');
            $userdetails-> save();
            return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);
    
}
else{
    return response()->json(['your not vendor']);
}
    }
public function getVendorAccountDetails(Request $request)
{  

$userdetails=Auth::user();  

  $res= DB::table('vendor')->leftjoin('vendor_account','vendor.id','=','vendor_account.vendor_id')
  ->leftjoin('users','vendor.ven_email','=','users.email')
  ->where('users.is_admin','=',2)
 // ->where('users.phonenumber','=','vendor.ven_phone')
  //->where('vendor.id','=',$request->id)
  ->select('vendor.ven_name','vendor.id','ven_phone','ven_email','venacc_name','venacc_bank_name','venacc_account_no','venacc_paymet_id','venacc_ifsc','is_admin')
  ->get();

  return response()->json(['vendor details'=>$res],200);
/*
else {
    return response()->json(['only admin have access']);
}*/
}

}
