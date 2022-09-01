<?php

namespace App\Http\Controllers\API\vendor\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Validation\VendoraddressRequest;

use App\Models\AddressModel;



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


public function addparkingslotdetails(VendoraddressRequest $request)
{ 


}





}
