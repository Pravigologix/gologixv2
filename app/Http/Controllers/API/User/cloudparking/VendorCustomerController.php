<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookParkingModel;


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
            ->where('users.is_admin','=',0)
            ->where('addresses.add_user_id','=',$user->id)
            ->select('users.name','users.id','users.phonenumber','email','add_city_id','add_pincode','add_description','is_admin','book_parking.id as booking_id','user_vehicle.useveh_vehicle_name','user_vehicle.useveh_vehicle_number','book_parking.parking_status')
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
            $data=BookParkingModel::
            with('address_details')->
            whereHas('address_details',function($qurey){
                // $qurey->where('is_cloud_parking',1);
                $qurey->where('add_user_id',Auth::user()->id);

            })
           -> with('user_details')
           ->with('parking_charge_details')
           ->with('all_parking_charge_details')

           ->with('parking_slot_address_details')


        
          
            ->paginate(80);
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

