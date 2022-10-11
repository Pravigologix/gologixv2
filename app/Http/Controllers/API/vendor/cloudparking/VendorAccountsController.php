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


  /*
        //if($user-> is_admin==2){
        $payment_status=DB::table('payments_status')->insert( [
            'paysta_status_name'=>$request->input( 'paysta_status_name' ),
            'paysta_description'=>$request->input( 'paysta_description' ),
            'paysta_isactive'=>$request->input( 'paysta_isactive' ),
            'paysta_isdeleted'=>$request->input( 'paysta_isdeleted' ),
            'user_id'=>$user->id,
        ] );
        if($payment_status){
            $payment_status_id=DB::table('payments_status')
            ->where('payments_status.user_id','=',$user->id)->first('id');
    */
  

 
           

          // dd($paymentid);
       
        $user= Auth::user();  
        //dd($user->id);
            $userdetails=new VendorAccounts;
            $userdetails->vendor_id=$request->input('vendor_id');
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

              
              
              
            }

//else{
 //   return response()->json(['your not vendor']);
//}
   // }
    /*
    public function editVendorAccountDetails(Request $request){

        $userdetails= Auth::user();  
        //dd($userdetails->id);

    $data=DB::table('vendor_account')
        ->where('vendor_account.vendor_id','=',$userdetails->id)
         ->where('vendor_account.id','=',$request->input('id'))
        ->update(['venacc_name'=>$request->input('venacc_name'),'venacc_bank_name'=>$request->input('venacc_bank_name'),'venacc_account_no'=>$request->input('venacc_account_no'),'venacc_ifsc'=>$request->input('venacc_ifsc')]);
      
   
      return response()->json(['data successfully updated.']);
  }

*/
public function getVendorAccountDetails(Request $request)
{  

$userdetails=Auth::user();

  $res= DB::table('vendor')->leftjoin('vendor_account','vendor.user_id','=','vendor_account.vendor_id')
  ->leftjoin('users','vendor.user_id','=','users.id')

//<<<<<<< branch4
//=======
//<<<<<<< branch1
 // $res= DB::table('vendor')->leftjoin('vendor_account','vendor.id','=','vendor_account.vendor_id')
 // ->leftjoin('users','vendor.ven_email','=','users.email')
//>>>>>>> branch5
  //->where('users.is_admin','=',3)
 // ->where('users.phonenumber','=','vendor.ven_phone')
  ->where('vendor_account.vendor_id','=',$userdetails->id)
  ->select('vendor.ven_name','vendor.id','ven_phone','ven_email','venacc_name','venacc_bank_name','venacc_account_no','venacc_paymet_id','venacc_ifsc','is_admin')
//=======
  //$res= DB::table('vendor_account')


  //->where('vendor_account.vendor_id','=',$userdetails->id)
  
//>>>>>>> main
  ->get();

  return response()->json(['vendor details'=>$res],200);
/*
else {
    return response()->json(['only admin have access']);
}*/
}

}
