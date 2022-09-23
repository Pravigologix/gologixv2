<?php

namespace App\Http\Controllers\API\vendor\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorKYC;
use DB;
use Auth;

class VendorkycController extends Controller
{
    public function addVendorkyc(Request $request){
        $vendordetails= Auth::user();  
       
            $vendordetails=new VendorKYC;
            $vendordetails->venkyc_docname=$request->input('venkyc_docname');
            $vendordetails->venkyc_docnumber=$request->input('venkyc_docnumber');
            $vendordetails->venkyc_venima_id =$request->input('venkyc_venima_id ');
            $vendordetails->venkyc_vendor_id=$request->input('venkyc_vendor_id');
            $vendordetails->venkyc_verifier_userid =$request->input('venkyc_verifier_userid');
            $vendordetails->venkyc_document_id=$request->input('venkyc_document_id');
            $vendordetails->venkyc_doctye_id=$request->input('venkyc_doctye_id');
            $vendordetails->venkyc_path=$request->input('venkyc_path');
            $vendordetails->venkyc_isapproved=$request->input('venkyc_isapproved');
            $vendordetails->venkyc_isactive=$request->input('venkyc_isactive');
            $vendordetails->venkyc_isdeleted=$request->input('venkyc_isdeleted');
            $vendordetails-> save();
            return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);
    
}

public function getVendorkyc(Request $request)
{  

$userdetails=Auth::user();

  $res= DB::table('vendor_kyc')
  ->join('vendor','vendor_kyc.venkyc_vendor_id','=','vendor.id')
  ->select('vendor.ven_name','ven_description','ven_address_id','ven_phone','ven_email','vendor_kyc.venkyc_docname','venkyc_docnumber','venkyc_path','venkyc_isapproved')
  ->where('vendor.id','=',$request->id)
  ->get();

  return response()->json(['vendor details'=>$res],200);
}

}
