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


public function addparkingslotdetails(VendoraddressSlotRequest  $request)
{ 

    try{

  $user= Auth::user();

    $parking_slot=new ParkingSlotModel;
    $parking_slot->parking_type=$request->input('parking_type');
    $parking_slot->parking_no=$request->input('parking_no');
    $parking_slot->starts_at=$request->input('starts_at');
    $parking_slot->ends_at=$request->input('ends_at');
    $parking_slot->parking_slots=$request->input('parking_slots');
    $parking_slot->address_id=$request->input('address_id');

    $parking_slot->user_id=$user->id;
    $parking_slot->save();

    $desc_id=$request->input('addparking_desc_ids');
    $amt=$request->input('parking_amt');
  

    foreach(array_combine($desc_id,$amt) as $desc_id=>$amt){
      DB::table('parking_charges')->insert([
        'vendor_id'=>$user->id,
        'parking_amt'=>$amt,
        'add_praking_desc_id'=>$desc_id,
        'add_praking_slot_id'=>$parking_slot->id,
        
      ]);



    }

    // $parking_desc->save();
    return response()->json(['message'=>'sucessfully updated','status'=>1],200);
}catch (Exception $e){
        return $e;
    }









   
    


}

public function getparkingslotdetails(VendoraddressSlotRequest $request)
{ 

  $user= Auth::user();  
  $parking_slot=ParkingSlotModel::where('user_id','=',$user->id)
  ->join('parking_charges','parking_charges.add_praking_slot_id','=','add_praking_slots.id')
  ->leftjoin('add_praking_desc','add_praking_desc.id','=','parking_charges.add_praking_desc_id')
  ->select('add_praking_desc.timings','add_praking_desc.is_active as desc_isactive','add_praking_desc.is_delette as desc_isdelete','parking_charges.id as parking_charge_id','parking_charges.vendor_id','parking_charges.parking_amt','parking_charges.add_praking_desc_id as parking_description_id','parking_charges.add_praking_slot_id','parking_charges.is_active as parking_charge_isactive','parking_charges.is_delete as parking_charge_isdelete','add_praking_slots.*')
  ->get();
  return $parking_slot;

}
public function getparkingdescdetails(Request $request)
{ 

  $parking_desc=DB::table('add_praking_desc')->get();

  return $parking_desc;

}


public function updateparkingslotdetails(Request $request)
{ 

  $user= Auth::user();  

  try{

  $parking_desc=DB::table('parking_charges')
  ->where('add_praking_slot_id','=',$request->input('add_praking_slot_id'))
  ->where('add_praking_desc_id','=',$request->input('add_praking_desc_id'))
  ->where('id','=',$request->input('parking_charge_id'))
  ->where('vendor_id','=',$user->id)

  ->update(
    [
      'parking_amt'=>$request->input('parking_amt'),
      'is_active'=>$request->input('parking_charge_isactive'),
      'is_delete'=>$request->input('parking_charge_isdelete')

    ]
  );

  $parking_slot=DB::table('add_praking_slots')
  ->where('id','=',$request->input('add_praking_slot_id'))
  ->where('user_id','=',$user->id)
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
