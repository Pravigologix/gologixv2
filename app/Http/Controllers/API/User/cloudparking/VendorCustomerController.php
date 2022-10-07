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
            ->where('users.is_admin','=',0)
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
          
            ->paginate(30);
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
/*

class VendorCustomerController extends Controller {
 

    public function customer( Request $request ) {

        //customer details
        $user = Auth::user();

        if ( $user != null ) {

            $data = DB::table( 'addresses' )
            ->join( 'users', 'addresses.add_user_id', '=', 'users.id' )
            ->leftjoin( 'book_parking', 'addresses.id', '=', 'address_id' )
            ->leftjoin( 'user_vehicle', 'users.id', '=', 'useveh_user_id' )
            ->select( 'users.name', 'users.email', 'users.phonenumber', 'is_admin', 'profile_photo_path', 'addresses.add_description', 'add_city_id', 'add_pincode', 'user_vehicle.useveh_vehicle_number' )
            ->where( 'addresses.add_user_id', '=', $user->id )
            // ->where( 'users.is_admin', '=', 1 )
            ->where( 'users.is_admin', '=', 0 )
            ->get();
            return response()->json( [ $data ], 200 );
        } else {
            return response()->json( [
                'status' => '0',
                'message' => 'user cridential not match',
            ] );
        }
    }
 

    public function vendor( Request $request ) {
        $user = Auth::user();
        if ( $user != null ) {
            $data = DB::table( 'book_parking' )
            ->leftjoin( 'addresses', 'book_parking.address_id', '=', 'addresses.id' )
            ->leftjoin( 'users', 'book_parking.user_id', '=', 'users.id' )
            ->leftjoin( 'user_vehicle', 'user_vehicle.useveh_user_id', '=', 'users.id' )
            ->where( 'addresses.add_user_id', '=', $user->id )
            ->select(
                'users.name as customer_name',
                'book_parking.address_id',
                'addresses.add_user_id as address_id',
                'users.id as user_id', 'users.phonenumber as user_mobile_number',
                'email', 'add_city_id',
                'add_pincode', 'add_description',
                'is_admin',
                   'user_vehicle.useveh_vehicle_name',
                'user_vehicle.useveh_vehicle_number',
                'book_parking.parking_status' )
               

                ->paginate( 30 );
                return response()->json( [ 'user_details_for_vendor'=>$data ], 200 );
            } else {
                return response()->json( [
                    'status' => '0',
                    'message' => 'user cridential not match',
                ] );
            }

        }

    }
*/
