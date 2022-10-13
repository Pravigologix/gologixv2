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
   
      $user= Auth::user();  

   
      $document=DB::table('documents')->insert([
        'doc_name'=>$request->input('doc_name'),
        'doc_description'=>$request->input('doc_description'),
        'doc_isactive'=>$request->input('doc_isactive'),
        'doc_isdeleted'=>$request->input('doc_isdeleted'),
        'user_id'=>$user->id,
    ]);
    if($document){
      $document_id=DB::table('documents')
     
      ->where('documents.user_id','=',$user->id)->latest('created_at')->first('id');

      //dd($document_id);

      $user= Auth::user();  

      $doctype=DB::table('documents_type')->insert([
        'doctyp_name'=>$request->input('doctyp_name'),
        'doctyp_description'=>$request->input('doctyp_description'),
        'doctyp_isactive'=>$request->input('doctyp_isactive'),
        'doctyp_isdeleted'=>$request->input('doctyp_isdeleted'),
        'user_id'=>$user->id,
      ]);
      if($doctype){
        $doctype_id=DB::table('documents_type')
        ->where('documents_type.user_id','=',$user->id)->first('id');
  
        $files=$request['venkyc_path'];
        $hostname=$_SERVER['HTTP_HOST'];
        
                $filejustname =pathinfo($files, PATHINFO_FILENAME);
                // Get just extension of user upload file
                $extention =$files->getClientOriginalExtension();
                $fileName = $filejustname .time() ."." .$extention ;
                $destinationPath = public_path().'/images'.'/kyc_docs';
                $fileupload=$files->move($destinationPath,$fileName);
                $kyc_docs=env('APP_URL').'/images'.'/kyc_docs'.'/'.$fileName; 

                $user= Auth::user();  

                $vendor=DB::table('vendor')->insert([
                  'ven_name'=>$request->input('ven_name'),
                  'ven_description'=>$request->input('ven_description'),
                  'ven_address_id'=>$request->input('ven_address_id'),
                  'ven_phone'=>$request->input('ven_phone'),
                  'ven_email'=>$request->input('ven_email'),
                  'user_id'=>$user->id,
              ]);
              if($vendor){
                $vendor_id=DB::table('vendor')
               
                ->where('vendor.user_id','=',$user->id)->first('id');
          
  // dd($vendor_id);
        $user= Auth::user();  
       //dd($user->id);

            $vendordetails=new VendorKYC;
            $vendordetails->venkyc_docname=$request->input('venkyc_docname');
            $vendordetails->venkyc_docnumber=$request->input('venkyc_docnumber');
            $vendordetails->venkyc_vendor_id=$vendor_id;
            $vendordetails->venkyc_verifier_userid =$request->input('venkyc_verifier_userid');
            $vendordetails->venkyc_document_id=$request->input('venkyc_document_id');
            $vendordetails->venkyc_doctye_id=$request->input('venkyc_doctye_id');
            $vendordetails->venkyc_path=json_encode($kyc_docs);
            $vendordetails->venkyc_isapproved=$request->input('venkyc_isapproved');
            $vendordetails->venkyc_isactive=$request->input('venkyc_isactive');
            $vendordetails->venkyc_isdeleted=$request->input('venkyc_isdeleted');

            $vendordetails-> save();


            return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);
      }
     }
    }
    }
      public function getVendorkyc(Request $request)
 {  

$vendordetails=Auth::user();

  $res= DB::table('vendor_kyc')
  ->join('vendor','vendor_kyc.venkyc_vendor_id','=','vendor.id')
  ->where('vendor.user_id','=',$vendordetails->id)
  ->whereNotNull('vendor_kyc.venkyc_path')
  ->select('vendor.ven_name','vendor.ven_description','vendor.ven_address_id','vendor.ven_phone','vendor.ven_email','vendor_kyc.venkyc_docname','venkyc_docnumber','venkyc_path','venkyc_isapproved')
  
  ->get();

  return response()->json(['vendor details kyc details'=>$res],200);
}

}
