<?php

namespace App\Http\Controllers\API\vendor\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Validation\VendoraddressRequest;
use App\Http\Requests\Validation\VendoraddressSlotRequest;

use App\Models\AddressModel;
use App\Models\ParkingSlotModel;
use App\Models\ParkingDescriptionModel;
use DB;

class AddParkingController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum', ['except' => [
    //         'getparkingdeatils',
    //         ]]);
    // }

    public function getparkingdeatils(Request $request)
    {  

$userdetails=Auth::user();




        

        if($userdetails->is_admin==1){

      $res= DB::table('addresses')->where('add_user_id','=',$userdetails->id)->where('add_isdeleted',0)
      ->get();

      return $res;
    }
    return response()->json(['status'=>'failed','message'=>'invalid credential'],301);




    }

    public function addparkingdetails(VendoraddressRequest $request)
    { 

$userdetails=Auth::user();
// if($userdetails==null){

    // dd($userdetails);
if($userdetails->is_admin==1){

    $addaddress=new AddressModel;

    
    $addaddress-> add_description= $request->input('add_description');
    $addaddress-> add_address= $request->input('add_address');
    $addaddress-> add_latitude= $request->input('add_latitude');
    $addaddress-> add_longitude= $request->input('add_longitude');
    $addaddress-> add_isactive =$request->input('add_isactive');
    $addaddress-> add_isdeleted=$request->input('add_isdeleted');
    $addaddress-> add_city_id= $request->input('add_city_id');

    $addaddress-> add_pincode=$request->input('add_pincode');
    $addaddress-> name=$request->input('name');
    $addaddress-> phonenumber=$request->input('phonenumber');
    $addaddress-> add_user_id=$userdetails->id;

    $addaddress-> save();

    

    return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);
}

return response()->json(['status'=>'failed','message'=>'invalid credential'],301);



    // }
// return response()->json(['status'=>'failed','message'=>'Unauthacticated'],301);

}

public function editparkingdetails(VendoraddressRequest $request)
{ 

$userdetails=Auth::user();
// if($userdetails==null){

// dd($userdetails);
if($userdetails->is_admin==1){

$addaddress=AddressModel::find($request->input('id'));


$addaddress-> add_description= $request->input('add_description');
$addaddress-> add_address= $request->input('add_address');
$addaddress-> add_latitude= $request->input('add_latitude');
$addaddress-> add_longitude= $request->input('add_longitude');
$addaddress-> add_isactive =$request->input('add_isactive');
$addaddress-> add_isdeleted=$request->input('add_isdeleted');
$addaddress-> add_city_id= $request->input('add_city_id');

$addaddress-> add_pincode=$request->input('add_pincode');
$addaddress-> name=$request->input('name');
$addaddress-> phonenumber=$request->input('phonenumber');


$addaddress-> save();



return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);
}

return response()->json(['status'=>'failed','message'=>'invalid credential'],301);





}


public function addparkingslotdetails(VendoraddressSlotRequest $request)
{ 

    try{

  $user= Auth::user();

    $parking_slot=new ParkingSlotModel;
    $parking_slot->parking_type=$request->input('parking_type');
    $parking_slot->parking_no=$request->input('parking_no');
    $parking_slot->starts_at=$request->input('starts_at');
    $parking_slot->ends_at=$request->input('ends_at');
    $parking_slot->parking_slots=$request->input('parking_slots');
    $parking_slot->user_id=$user->id;
    $parking_slot->save();

    $parking_desc=new ParkingDescriptionModel;
    $parking_desc->is_two_hrs=$request->input('is_two_hrs');
    $parking_desc->is_four_hrs=$request->input('is_four_hrs');
    $parking_desc->is_eight_hrs=$request->input('is_eight_hrs');
    $parking_desc->more=$request->input('more');
    $parking_desc->is_rent=$request->input('is_rent');
    $parking_desc->is_two_hrs_amt=$request->input('is_two_hrs_amt');
    $parking_desc->is_four_hrs_amt=$request->input('is_four_hrs_amt');
    $parking_desc->is_eight_hrs_amt=$request->input('is_eight_hrs_amt');
    $parking_desc->more_amt=$request->input('more_amt');
    $parking_desc->is_rent_amt=$request->input('is_rent_amt');
    $parking_desc->add_praking_slot_id=$parking_slot->id;
    $parking_desc->save();
    return $parking_desc;
}catch (Exception $e){
        return $e;
    }









   
    


}

public function getparkingslotdetails(Request $request)
{ 

  $user= Auth::user();  
  $parking_slot=ParkingSlotModel::where('user_id','=',$user->id)
  ->join('add_praking_desc','add_praking_desc.add_praking_slot_id','=','add_praking_slot.id')
  ->get();
  return $parking_slot;

}

public function updateparkingslotdetails(VendoraddressSlotRequest $request)
{ 

  $user= Auth::user();  

  try{

  $parking_desc=ParkingDescriptionModel::where('add_praking_slot_id','=',$request->input('add_praking_slot_id'))->where('id','=',$request->id)
  ->update(
    [
        "is_two_hrs"=>$request->input('is_two_hrs'),
        "is_four_hrs"=>$request->input('is_four_hrs'),
        "is_eight_hrs"=>$request->input('is_eight_hrs'),
        "more"=>$request->input('more'),
        "is_rent"=>$request->input('is_rent'),
        "is_two_hrs_amt"=>$request->input('is_two_hrs_amt'),
        "is_four_hrs_amt"=>$request->input('is_four_hrs_amt'),
        "is_eight_hrs_amt"=>$request->input('is_eight_hrs_amt'),
        "more_amt"=>$request->input('more_amt'),
        "is_rent_amt"=>$request->input('is_rent_amt')

    ]
  );

  $parking_slot=ParkingSlotModel::where('id','=',$request->input('add_praking_slot_id'))->where('user_id','=',$user->id)
  ->update(
    [
        "parking_type"=>$request->input('parking_type'),
        "parking_no"=>$request->input('parking_no'),
        "starts_at"=>$request->input('starts_at'),
        "ends_at"=>$request->input('ends_at'),
        "parking_slots"=>$request->input('parking_slots'),
      

    ]
  );

   
  



    return response()->json(['status'=>($parking_desc&&$parking_slot),'message'=>"updated Sucessfully"],200);
}
    catch (Exception $e){
        // return $e;
    return response()->json(['status'=>'0','message'=>$e],401);

    }
  



}





}
