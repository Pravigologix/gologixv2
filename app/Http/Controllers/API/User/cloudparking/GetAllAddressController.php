<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddressModel;
use DB;
use Auth;

class GetAllAddressController extends Controller
{
    public function getAllAddress(Request $request)
    { 

    //dd($user->id);
     $add=AddressModel::where('is_cloud_parking','=',1)->
     with('praking_charge')->with('praking_slot')->
     
     get();
     return response()->json(['status'=>'Sucess','message'=>$add],200);
    }

    public function addAddress(Request $request)
    {
        $user= Auth::user(); 
        //dd($user->id); 
        $address=new AddressModel;
        $address->name=$request->input('name');
        $address->phonenumber=$request->input('phonenumber');
        $address->alt_phonenumber=$request->input('alt_phonenumber');
        $address->add_description=$request->input('add_description');
        $address->add_address=$request->input('add_address');
        $address->add_city_id=$request->input('add_city_id');
        $address->add_pincode=$request->input('add_pincode');
        $address->add_latitude=$request->input('add_latitude');
        $address->add_longitude=$request->input('add_longitude');
        $address->add_is_default=$request->input('add_is_default');
        $address->add_user_id=$user->id;
        $address->add_isactive=$request->input('add_isactive');
        $address->add_isdeleted=$request->input('add_isdeleted');
        $address->is_cloud_parking=$request->input('is_cloud_parking');

        $address->save();

        return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);

    }
}

