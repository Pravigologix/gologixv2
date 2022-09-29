<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class VendorCustomerController extends Controller
{
    
    public function customer(Request $request){
        
        //customer details
        $user = Auth::user();

      if($user!=null){

        
        $data=DB::table('book_parking')
            ->leftjoin('addresses','book_parking.address_id','=','addresses.id')
            ->leftjoin('users','book_parking.user_id','=','users.id')
            ->leftjoin('user_vehicle','user_vehicle.useveh_user_id','=','users.id')
            //->where('users.id','=','addresses.add_user_id')
            ->where('users.is_admin','=',3)
           // ->where('addresses.add_user_id','=',$user->id)
            ->select('users.name','users.id','users.phonenumber','email','add_city_id','add_pincode','add_description','is_admin','user_vehicle.useveh_vehicle_name','user_vehicle.useveh_vehicle_number','book_parking.parking_status')
            // 
        ->paginate(6);
        return response()->json(["user_details_for_vendor"=>$data],200);
    }
    else{
        return response()->json([
            'status' => '0',
            'message' => "user cridential not match", 
        ]);
    }
    }
    public function vendor(Request $request){
        $user = Auth::user();
        //dd($user->id);
        if($user!=null){
            $data=DB::table('book_parking')
            ->leftjoin('addresses','book_parking.address_id','=','addresses.id')
            ->leftjoin('users','book_parking.user_id','=','users.id')
            ->leftjoin('user_vehicle','user_vehicle.useveh_user_id','=','users.id')
            //->where('users.id','=','addresses.add_user_id')
            ->where('users.is_admin','=',2)
           // ->where('addresses.add_user_id','=',$user->id)
            ->select('users.name','users.id','users.phonenumber','email','add_city_id','add_pincode','add_description','is_admin','user_vehicle.useveh_vehicle_name','user_vehicle.useveh_vehicle_number','book_parking.parking_status')
            // 
          
            ->paginate(6);
            return response()->json(["user_details_for_vendor"=>$data],200);
        }
        else{
            return response()->json([
                'status' => '0',
                'message' => "user cridential not match", 
            ]);
        }

}
}    

