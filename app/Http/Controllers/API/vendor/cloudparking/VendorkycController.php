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

      
 
      
 
       $files=$request['doc1'];
       $hostname=$_SERVER['HTTP_HOST'];
       
               $filejustname =pathinfo($files, PATHINFO_FILENAME);
               // Get just extension of user upload file
               $extention =$files->getClientOriginalExtension();
               $fileName = $filejustname .time() ."." .$extention ;
               $destinationPath = public_path().'/images'.'/profile';
               $fileupload=$files->move($destinationPath,$fileName);
               $profile_image1=env('APP_URL').'/images'.'/profile'.'/'.$fileName; 
               $files1=$request['doc2'];
               $hostname1=$_SERVER['HTTP_HOST'];
               
                       $filejustname1 =pathinfo($files1, PATHINFO_FILENAME);
                       // Get just extension of user upload file
                       $extention1 =$files1->getClientOriginalExtension();
                       $fileName1 = $filejustname1 .time() ."." .$extention1 ;
                       $destinationPath1 = public_path().'/images'.'/profile';
                       $fileupload1=$files1->move($destinationPath1,$fileName1);
                       $profile_image2=env('APP_URL').'/images'.'/profile'.'/'.$fileName1; 
 
       $details_update=DB::table('vendor_new_kyc')->insert([
        'user_id'=>$request->input('user_id'),
        'doc2'=>$profile_image2,
       'addhar_number'=>$request->input('addhar_number'),
     
         'doc1'=>$profile_image1,
         'status'=>1
         
         ]
       );
 
         return response()->json( [ 'message'=>'Details image uploaded sucessfully' ], 200 );
 
 
     
    }
      public function getVendorkyc(Request $request){
          
      $vendordetails=Auth::user();

      $res= DB::table('vendor_new_kyc')->where('user_id',$vendordetails->id)
      
      ->get();

  return response()->json(['vendor details kyc details'=>$res],200);
}

}
