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

       
        $user= Auth::user();  
        //dd($user->id);
            $userdetails=new VendorAccounts;
            $userdetails->vendor_id=$user->id;
            $userdetails->venacc_name=$request->input('venacc_name');
            $userdetails->venacc_alias=$request->input('venacc_alias');
            $userdetails->venacc_bank_name=$request->input('venacc_bank_name');
            $userdetails->venacc_account_no=$request->input('venacc_account_no');
            $userdetails->venacc_paymet_id=1;
            $userdetails->venacc_ifsc=$request->input('venacc_ifsc');
            $userdetails->venacc_isactive=$request->input('venacc_isactive');
            $userdetails->venacc_isdeleted=$request->input('venacc_isdeleted');
            $userdetails-> save();
            return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);

              
              
           // return response()->json([$userdetails]);
            }



   
    public function editVendorAccountDetails(Request $request){

        $userdetails= Auth::user();  
       

    $data=DB::table('vendor_account')
        ->where('vendor_account.id','=',$request->input('id'))
       
        ->update(['venacc_name'=>$request->input('venacc_name'),'venacc_alias'=>$request->input('venacc_alias'),'venacc_ifsc'=>$request->input('venacc_ifsc'),'venacc_bank_name'=>$request->input('venacc_bank_name'),'venacc_account_no'=>$request->input('venacc_account_no'),'venacc_ifsc'=>$request->input('venacc_ifsc')]);
      
       
      return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);

   
  }


public function getVendorAccountDetails(Request $request)

{
  $user= Auth::user();  

  $data=DB::table('vendor_account')
        ->where('vendor_account.vendor_id','=',$user->id)
        ->get();
  return response()->json(["vendor account details"=>$data],200);
}
}
 