<?php

namespace App\Http\Controllers\API\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;

class Profile extends Controller {
    public function getprofile( Request $request ) {
        $user = Auth::user();

        $get_user_details =  DB::table( 'users' )->where( 'id', '=', $user->id )
        ->select( 'name', 'email', 'phonenumber', 'profile_photo_path' )
        ->get();

        return response()->json( [ 'userdetails'=>$get_user_details ], 200 );

    }


     public function addprofile(Request $request)
     {


        $user = Auth::user();

        $path = $request->file( 'profile_image' )->store( 'public/image' );

        $url = Storage::file( $path );


      $details_update=DB::table('users')->where('id','=',$user->id)
      
      ->update([
        'profile_photo_path'=>env('APP_URL').'/'.$url
      ]);

        return response()->json( [ 'message'=>'Profile image uploaded sucessfully', 'image'=>$url ], 200 );

    }
}
