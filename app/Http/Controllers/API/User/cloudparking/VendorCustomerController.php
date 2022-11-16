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
        
      
      
        if($user!=null){
            if($user->is_admin==6){
                $vendorid=DB::table('employees')->where('user_id',$user->id)->first('vendor_id');
             $iddata=$vendorid->vendor_id;
                $data=BookParkingModel::
                with('address_details')->
                whereHas('address_details',function($qurey)use($iddata){
                    // $qurey->where('is_cloud_parking',1);
                    $qurey->where('add_user_id',$iddata);
    
                })
               -> with('user_details')
               ->with('parking_charge_details')
               ->with('all_parking_charge_details')
    
               ->with('parking_slot_address_details')
                    ->orderBy("id", "desc");
                
                if($request->name){
                    $data->whereHas('user_details',function($qurey) use($request){
                             $qurey->where( 'name','Like','%'.$request->name.'%');
                        }
                                   );
                
                }
                
                if($request->type){
                    $data->where('paking_type','Like','%'.$request->type.'%');
                
                }
                 if($request->parking_status){
                    $data->where('parking_status','Like','%'.$request->parking_status.'%');
                
                }
                 if($request->startdate){
                    $data->whereDate('start_date','Like','%'.$request->start_date.'%');
                
                }
                return response()->json(["user_details_for_vendor"=>$data->paginate(10)],200);
            }
            
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
                ->orderBy("id", "desc");
            
            if($request->name){
                $data->whereHas('user_details',function($qurey) use($request){
                         $qurey->where( 'name','Like','%'.$request->name.'%');
                    }
                               );
            
            }
            
            if($request->type){
                $data->where('paking_type','Like','%'.$request->type.'%');
            
            }
             if($request->parking_status){
                $data->where('parking_status','Like','%'.$request->parking_status.'%');
            
            }
             if($request->startdate){
                $data->whereDate('start_date','Like','%'.$request->start_date.'%');
            
            }
            return response()->json(["user_details_for_vendor"=>$data->paginate(10)],200);
        }
        else{
            return response()->json([
                'status' => '0',
                'message' => "user cridential not match", 
            ]);
        }

}
}    

