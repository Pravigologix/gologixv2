<?php

namespace App\Http\Controllers\API\vendor\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorDetails;
use DB;
use Auth;

class VendorDetailsController extends Controller
{


    public function addVendorDetails(Request $request){
//<<<<<<< ashwini
        $user= Auth::user();  
//=======
      $userdetails= Auth::user();  
      if($userdetails-> is_admin==2){
//>>>>>>> main
            $userdetails=new VendorDetails;
            $userdetails->ven_name=$request->input('ven_name');
            $userdetails->ven_description=$request->input('ven_description');
            $userdetails->ven_address_id =$request->input('ven_address_id ');
            $userdetails->ven_phone=$request->input('ven_phone');
            $userdetails->ven_mobile=$request->input('ven_mobile');
            $userdetails->ven_email=$request->input('ven_email');
            $userdetails->ven_information=$request->input('ven_information');
            $userdetails->ven_admin_commission=$request->input('ven_admin_commission');
            $userdetails->gst_no=$request->input('gst_no');
            $userdetails->ven_default_tax=$request->input('ven_default_tax');
            $userdetails->ven_isactive=$request->input('ven_isactive');
            $userdetails->ven_isdeleted=$request->input('ven_isdeleted');
            $userdetails->user_id=$request->input('user_id');

            $userdetails-> save();
            return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);
      
}
    }
public function editVendorDetails(Request $request){

  $userdetails= Auth::user();  
  //dd($userdetails->id);

$data=DB::table('vendor')->where('vendor.id','=',$userdetails->id)->update(['ven_description'=>$request->input('ven_description')]);

//$d=DB::table('banners')->get();
// return $d;
return response()->json(['data successfully updated.']);
}





public function getVendorDetails(Request $request)
{  

$userdetails=Auth::user();  

  $res= DB::table('vendor')->select('vendor.ven_name','vendor.id','ven_description','ven_address_id','ven_phone','ven_email','ven_isactive','gst_no')
  ->where('vendor.user_id','=',$userdetails->id)
  ->get();

  return $res;

}



}