<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\vehicle;
use Auth;
use DB;

class VehicleController extends Controller
{
    public function addVehicle(Request $request){
        $user= Auth::user();  
       // dd($userdetails->id);
        $userdetails=new vehicle;
        $userdetails->useveh_vehicle_name=$request->input('useveh_vehicle_name');
        $userdetails->useveh_vehicle_number=$request->input('useveh_vehicle_number');
        $userdetails->useveh_user_id=(int)$user->id;
        $userdetails->useveh_isactive=$request->input('useveh_isactive');
        $userdetails->useveh_isdelete=$request->input('useveh_isdelete');
        $userdetails-> save();
       return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);

    }
      public function editVehicle(Request $request){

        $userdetails= Auth::user();  
        //dd($userdetails->id);

    $data=DB::table('user_vehicle')->where('user_vehicle.useveh_user_id','=',$userdetails->id)->update(['useveh_vehicle_name'=>$request->input('useveh_vehicle_name'),'useveh_vehicle_number'=>$request->input('useveh_vehicle_number')]);
      
    //$d=DB::table('banners')->get();
    // return $d;
      return response()->json(['data successfully updated.']);
  }
  

  public function getVehicle(Request $request){
    $userdetails= Auth::user(); 
    /
    $data=DB::table('user_vehicle')
    
    ->where('user_vehicle.useveh_user_id','=',$userdetails->id)
    ->get();
    return $data;
  }


}

