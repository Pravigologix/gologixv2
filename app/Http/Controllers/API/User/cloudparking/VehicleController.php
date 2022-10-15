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
       if($user){
        $userdetails=new vehicle;
        $userdetails->useveh_vehicle_name=$request->input('useveh_vehicle_name');
        $userdetails->useveh_vehicle_number=$request->input('useveh_vehicle_number');
        $userdetails->useveh_user_id=(int)$user->id;
        $userdetails->useveh_isactive=$request->input('useveh_isactive');
        $userdetails->useveh_isdelete=$request->input('useveh_isdelete');
        $userdetails-> save();
       return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);
       }else{
           return response()->json(['status'=>'failed','message'=>'Something went worng '],303);
       }

    }
      public function editVehicle(Request $request){

        $userdetails= Auth::user();  
       

    $data=DB::table('user_vehicle')->where('id','=',$request->input('id'))
        //->where('user_vehicle.useveh_user_id','=',$userdetails->id)
        ->update(['useveh_vehicle_name'=>$request->input('useveh_vehicle_name'),'useveh_vehicle_number'=>$request->input('useveh_vehicle_number'),'useveh_isactive'=>$request->input('useveh_isactive'),'useveh_isdelete'=>$request->input('useveh_isdelete')]);
      
   
      return response()->json(['message'=>'data updated','status'=>true],200);
  }
  

  public function getVehicle(Request $request){
    $userdetails= Auth::user(); 
    
    $data=DB::table('user_vehicle')
    
    ->where('user_vehicle.useveh_user_id','=',$userdetails->id)
    ->get();
    return response(["vehicel"=>$data],200);
  }


}

