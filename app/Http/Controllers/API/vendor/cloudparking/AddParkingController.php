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
use App\Models\ParkingChargeModel;
use DB;

class AddParkingController extends Controller {
    // public function __construct()
    // {
    //     $this->middleware( 'auth:sanctum', [ 'except' => [
    //         'getparkingdeatils',
    // ] ] );
    // }

    public function getparkingdeatils( Request $request ) {

        $userdetails = Auth::user();

        if ( $userdetails-> is_admin == 2 ) {

            $res = DB::table( 'addresses' )->where( 'add_user_id', '=', $userdetails->id )->where( 'add_isdeleted', 0 )
            ->get();

            return response()->json( [ 'myslot'=>$res ], 200 );
        }
        return response()->json( [ 'status'=>'failed', 'message'=>'invalid credential' ], 301 );

    }

    public function addparkingdetails( VendoraddressRequest $request ) {

        $userdetails = Auth::user();
        // if ( $userdetails == null ) {

        // dd( $userdetails );
        if ( $userdetails->is_admin == 2 ) {

            $addaddress = new AddressModel;

            $addaddress-> add_description = $request->input( 'add_description' );
            $addaddress-> add_address = $request->input( 'add_address' );
            $addaddress-> add_latitude = $request->input( 'add_latitude' );
            $addaddress-> add_longitude = $request->input( 'add_longitude' );
            $addaddress-> add_isactive = $request->input( 'add_isactive' );
            $addaddress-> add_isdeleted = $request->input( 'add_isdeleted' );
            $addaddress-> add_city_id = $request->input( 'add_city_id' );

            $addaddress-> add_pincode = $request->input( 'add_pincode' );
            $addaddress-> name = $request->input( 'name' );
            $addaddress-> phonenumber = $request->input( 'phonenumber' );
            $addaddress-> add_user_id = $userdetails->id;

            $addaddress-> save();

            return response()->json( [ 'status'=>'Sucess', 'message'=>'Deatils uploaded sucessfully' ], 200 );
        }

        return response()->json( [ 'status'=>'failed', 'message'=>'invalid credential' ], 301 );

//<<<<<<< backupnew
        // }
        // return response()->json( [ 'status'=>'failed', 'message'=>'Unauthacticated' ], 301 );
//=======
    // }
// return response()->json(['status'=>'failed','message'=>'Unauthacticated'],301);

}

//public function editparkingdetails(VendoraddressRequest $request)
//{ 

//$userdetails=Auth::user();
// if($userdetails==null){

// dd($userdetails);
//if($userdetails-> is_admin==2){

//$addaddress=AddressModel::find($request->input('id'));


//$addaddress-> add_description=$request->input('add_description');
//$addaddress-> add_address= $request->input('add_address');
//$addaddress-> add_latitude= $request->input('add_latitude');
//$addaddress-> add_longitude= $request->input('add_longitude');
//$addaddress-> add_isactive =$request->input('add_isactive');
//$addaddress-> add_isdeleted=$request->input('add_isdeleted');
//$addaddress-> add_city_id= $request->input('add_city_id');

//$addaddress-> add_pincode=$request->input('add_pincode');
//$addaddress-> name=$request->input('name');
//$addaddress-> phonenumber=$request->input('phonenumber');
//>>>>>>> main

  //  }

    public function editparkingdetails( VendoraddressRequest $request ) {

        $userdetails = Auth::user();
        // if ( $userdetails == null ) {

        // dd( $userdetails );
        if ( $userdetails-> is_admin == 2 ) {

            $addaddress = AddressModel::find( $request->input( 'id' ) );

            $addaddress-> add_description = $request->input( 'add_description' );
            $addaddress-> add_address = $request->input( 'add_address' );
            $addaddress-> add_latitude = $request->input( 'add_latitude' );
            $addaddress-> add_longitude = $request->input( 'add_longitude' );
            $addaddress-> add_isactive = $request->input( 'add_isactive' );
            $addaddress-> add_isdeleted = $request->input( 'add_isdeleted' );
            $addaddress-> add_city_id = $request->input( 'add_city_id' );

            $addaddress-> add_pincode = $request->input( 'add_pincode' );
            $addaddress-> name = $request->input( 'name' );
            $addaddress-> phonenumber = $request->input( 'phonenumber' );
            $addaddress-> is_cloud_parking = $request->input( 'is_cloud_parking' );

            $addaddress-> save();

            return response()->json( [ 'status'=>'Sucess', 'message'=>'Deatils uploaded sucessfully' ], 200 );
        }

        return response()->json( [ 'status'=>'failed', 'message'=>'invalid credential' ], 301 );

    }

    public function addparkingslotdetails( VendoraddressSlotRequest  $request ) {

        try {

            $user = Auth::user();

            $parking_slot = new ParkingSlotModel;
            $parking_slot->parking_type = $request->input( 'parking_type' );
            $parking_slot->parking_no = $request->input( 'parking_no' );
            $parking_slot->starts_at = $request->input( 'starts_at' );
            $parking_slot->ends_at = $request->input( 'ends_at' );
            $parking_slot->parking_slots = $request->input( 'parking_slots' );
            $parking_slot->address_id = $request->input( 'address_id' );

            $parking_slot->user_id = $user->id;
            $parking_slot->save();

            $desc_id = $request->input( 'addparking_desc_ids' );
            $amt = $request->input( 'parking_amt' );

            foreach ( array_combine( $desc_id, $amt ) as $desc_id=>$amt ) {
                DB::table( 'parking_charges' )->insert( [
                    'vendor_id'=>$user->id,
                    'parking_amt'=>$amt,
                    'add_praking_desc_id'=>$desc_id,
                    'add_praking_slot_id'=>$parking_slot->id,

                ] );

            }

            // $parking_desc->save();
            return response()->json( [ 'message'=>'sucessfully updated', 'status'=>1 ], 200 );
        } catch ( Exception $e ) {
            return $e;
        }

    }

    public function getparkingslotdetails( Request $request ) {

        $user = Auth::user();

        $parking_slot = ParkingSlotModel::where( 'user_id', '=', $user->id )->where( 'add_praking_slots.is_active', 0 )
        ->join( 'addresses', 'add_praking_slots.address_id', '=', 'addresses.id' )
        ->select( 'addresses.add_description', 'addresses.add_address', 'add_praking_slots.*' )
        ->get();

        return response()->json( [ 'myslot'=>$parking_slot ], 200 );

    }

    public function getparkingdescdetails( Request $request ) {

        $parking_desc = DB::table( 'add_praking_desc' )->get();

        return $parking_desc;

    }
    public function addparkingdescdetails( Request $request ) {

        $parking_desc = DB::table( 'add_praking_desc' )->insert([
            'timings'=>$request->input('timings'),
            'is_active'=>$request->input('is_active'),

        ]);

        return $parking_desc;

    }

    public function getparkingcharges( Request $request ) {

        $parking_desc = ParkingChargeModel::
        with( 'add_praking_desc' )->with( 'add_praking_slot' )
        ->where( 'add_praking_slot_id', '=', $request->input( 'slot_id' ) )

        ->get();
        $address = AddressModel::

        where( 'id', '=', $request->input( 'add_id' ) )

        ->get();

        return response()->json( [ 'parking_desc'=>$parking_desc, 'address'=>$address ], 200 );

    }

    public function updateparkingslotdetails( Request $request ) {

        $user = Auth::user();

        try {

            $parking_desc = DB::table( 'parking_charges' )
            ->where( 'add_praking_slot_id', '=', $request->input( 'add_praking_slot_id' ) )
            ->where( 'add_praking_desc_id', '=', $request->input( 'add_praking_desc_id' ) )
            ->where( 'id', '=', $request->input( 'parking_charge_id' ) )
            ->where( 'vendor_id', '=', $user->id )

            ->update(
                [
                    'parking_amt'=>$request->input( 'parking_amt' ),
                    'is_active'=>$request->input( 'parking_charge_isactive' ),
                    'is_delete'=>$request->input( 'parking_charge_isdelete' )

                ]
            );

            $parking_slot = DB::table( 'add_praking_slots' )
            ->where( 'id', '=', $request->input( 'add_praking_slot_id' ) )
            ->where( 'user_id', '=', $user->id )
            ->update(
                [
                    'parking_type'=>$request->input( 'parking_type' ),
                    'parking_no'=>$request->input( 'parking_no' ),
                    'starts_at'=>$request->input( 'starts_at' ),
                    'ends_at'=>$request->input( 'ends_at' ),
                    'parking_slots'=>$request->input( 'parking_slots' ),

                ]
            );

            return response()->json( [ 'status'=>( $parking_desc && $parking_slot ), 'message'=>'updated Sucessfully' ], 200 );
        } catch ( Exception $e ) {
            // return $e;
            return response()->json( [ 'status'=>'0', 'message'=>$e ], 401 );

        }

    }
//<<<<<<< backupnew
//=======


}




//>>>>>>> main

// }
