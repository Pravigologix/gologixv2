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

/*
      $document=DB::table('documents')->insert([
        'doc_name'=>$request->input('doc_name'),
        'doc_description'=>$request->input('doc_description'),

        'doc_isactive'=>$request->input('doc_isactive'),
        'doc_isdeleted'=>$request->input('doc_isdeleted'),
        'user_id'=>$request->input('user_id'),

    ]);
    if($document){
      $document_id=DB::table('documents')
     
      ->where('documents.user_id','=',$request->input('user_id'))->first('id');
      */
        $user= Auth::user();  
      // dd($user->id);
            $vendordetails=new VendorKYC;
            $vendordetails->venkyc_docname=$request->input('venkyc_docname');
            $vendordetails->venkyc_docnumber=$request->input('venkyc_docnumber');
            $vendordetails->venkyc_vendor_id=(int)$user->id;
            $vendordetails->venkyc_verifier_userid =$request->input('venkyc_verifier_userid');
            $vendordetails->venkyc_document_id=$request->input('venkyc_document_id');
            $vendordetails->venkyc_doctye_id=$request->input('venkyc_doctye_id');
            $vendordetails->venkyc_path=$request->input('venkyc_path');
            $vendordetails->venkyc_isapproved=$request->input('venkyc_isapproved');
            $vendordetails->venkyc_isactive=$request->input('venkyc_isactive');
            $vendordetails->venkyc_isdeleted=$request->input('venkyc_isdeleted');

            $vendordetails-> save();

            return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);
    
//}
    }
public function getVendorkyc(Request $request)
{  

$vendordetails=Auth::user();

  $res= DB::table('vendor_kyc')
  ->join('vendor','vendor_kyc.venkyc_vendor_id','=','vendor.id')
  ->where('vendor.user_id','=',$vendordetails->id)
  ->select('vendor.ven_name','ven_description','ven_address_id','ven_phone','ven_email','vendor_kyc.venkyc_docname','venkyc_docnumber','venkyc_path','venkyc_isapproved')
  
  ->get();

  return response()->json(['vendor details kyc details'=>$res],200);
}

}
