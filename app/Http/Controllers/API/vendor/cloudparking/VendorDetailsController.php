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

        $user= Auth::user();  

      $userdetails= Auth::user();
      $addresses=DB::table('addresses')->insert([
        //'id'=>$request->input('id'),
        'add_address'=>$request->input('add_address'),
        'add_description'=>$request->input('add_description'),
        'add_city_id'=>$request->input('add_city_id'),
        'add_pincode'=>$request->input('add_pincode'),
        'add_latitude'=>$request->input('add_latitude'),
        'add_longitude'=>$request->input('add_longitude'),
        'add_isactive'=>$request->input('add_isactive'),
        'add_isdeleted'=>$request->input('add_isdeleted'),
        'add_user_id'=>$user->id,
    ]);
    $userdetails= Auth::user();

    if($addresses){
     $addresses_id=DB::table('addresses')
     
      ->where('addresses.add_user_id','=',$userdetails->id)
     // ->latest('created_at')
      ->first('id');
      $user= Auth::user();
      if($user-> is_admin==2){
            //dd($userdetails->id);
            $userdetails=new VendorDetails;
            $userdetails->ven_name=$request->input('ven_name');
            $userdetails->ven_description=$request->input('ven_description');
            $userdetails->ven_address_id =$request->input('ven_address_id');
            $userdetails->ven_phone=$request->input('ven_phone');
            $userdetails->ven_mobile=$request->input('ven_mobile');
            $userdetails->ven_email=$request->input('ven_email');
            $userdetails->ven_information=$request->input('ven_information');
            $userdetails->ven_admin_commission=$request->input('ven_admin_commission');
            $userdetails->gst_no=$request->input('gst_no');
            $userdetails->ven_default_tax=$request->input('ven_default_tax');
            $userdetails->ven_isactive=$request->input('ven_isactive');
            $userdetails->ven_isdeleted=$request->input('ven_isdeleted');
            $userdetails->user_id=$user->id;

            $userdetails->save();
        
          return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);
      
}
    }
    }
public function editVendorDetails(Request $request){

  
  $userdetails= Auth::user();  
       

  $data=DB::table('vendor')
      ->where('vendor.id','=',$request->input('id'))
     
      ->update(['ven_name'=>$request->input('ven_name'),
      'ven_description'=>$request->input('ven_description'),
      'ven_address_id'=>$request->input('ven_address_id'),
      'ven_phone'=>$request->input('ven_phone'),
      'ven_mobile'=>$request->input('ven_mobile'),
      'ven_email'=>$request->input('ven_email'),
      'ven_information'=>$request->input('ven_information'),
      'ven_admin_commission'=>$request->input('ven_admin_commission'),
      'ven_default_tax'=>$request->input('ven_default_tax'),
      'ven_isactive'=>$request->input('ven_isactive'),
      'ven_isdeleted'=>$request->input('ven_isdeleted')]);
    
     
    return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);

 
}

public function getVendorDetails(Request $request)
{  

   $userdetails=Auth::user();  

   $res= DB::table('vendor')
   ->join('addresses','vendor.user_id','addresses.add_user_id')
   ->select('vendor.user_id','vendor.ven_name','vendor.id as vendor_id','ven_description',
   'ven_address_id as vendor_address_id','ven_phone','ven_email','ven_isactive',
   'gst_no','addresses.id as address_id','addresses.add_address','addresses.add_description','addresses.add_city_id','add_pincode','add_latitude','add_longitude','add_isactive','add_isdeleted','add_user_id')
  
  ->where('vendor.user_id','=',$userdetails->id)
 
  ->get();

  return response()->json(['vendorDetails'=>$res],200);

}


public function getvendordashboarddetails(Request $request)
{  

  $bookingcount=DB::table('addresses')->where('add_user_id','=',$request->input('user_id'))
  ->leftJoin('book_parking','addresses.id','=','book_parking.address_id')

  ->count();

  $parkingcount=DB::table('addresses')->where('addresses.add_user_id','=',$request->input('user_id'))
  ->leftJoin('add_praking_slots','addresses.id','=','add_praking_slots.address_id')
  ->select('add_praking_slots.parking_type','add_praking_slots.parking_slots')->get();

  $bookedbiketype=DB::table('addresses') ->where('addresses.add_user_id','=',$request->input('user_id'))
  ->leftJoin('book_parking','addresses.id','=','book_parking.address_id')
 
  ->where('book_parking.paking_type','=',1)
  ->where('book_parking.parking_status','=',1)

  ->count();

  $bookedcartype=DB::table('addresses') ->where('addresses.add_user_id','=',$request->input('user_id'))
  ->leftJoin('book_parking','addresses.id','=','book_parking.address_id')
 
  ->where('book_parking.paking_type','=',2)
  ->where('book_parking.parking_status','=',1)

  ->count();


  return response()->json([
    "booking_count"=>$bookingcount,
    "parking_count"=>$parkingcount,
    "bookedbiketype_count"=>$bookedbiketype,
    "bookedcartype_count"=>$bookedcartype,

  ],200);

}

}
