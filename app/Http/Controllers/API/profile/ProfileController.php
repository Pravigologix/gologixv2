<?php

namespace App\Http\Controllers\API\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller {
    public function getprofile( Request $request ) {
        $user = Auth::user();

        $get_user_details =  DB::table( 'users' )->where( 'id', '=', $user->id )
        ->select( 'name', 'email', 'phonenumber', 'profile_photo_path' )
        ->get();

        return response()->json( [ 'userdetails'=>$get_user_details ], 200 );

    }

//<<<<<<< ashwini
     public function addprofile(Request $request)
    // {
//=======
    //public function addprofilepicture( Request $request ) {
//>>>>>>> main
        $user = Auth::user();

        //   $imagedata =  Storage::put( $request->file( 'profile_image' ), 'image' );
        // $name = $request->file( 'profile_image' )->getClientOriginalName();
        // dd( $request->file( 'profile_image' ) );

        $path = $request->file( 'profile_image' )->store( 'public/image' );

        $url = Storage::url( $path );

//<<<<<<< ashwini
      $details_update=DB::table('users')->where('id','=',$user->id)
      
      ->update([
        'profile_photo_path'=>env('APP_URL').'/'.$url
      ]);
//=======
     //   $details_update =  DB::table( 'users' )->where( 'id', '=', $user->id )
//>>>>>>> main

        // ->update( [
        //     'profile_photo_path'=>env( 'APP_URL' ).'/'.$url
        // ] );

        return response()->json( [ 'message'=>'Profile image uploaded sucessfully', 'image'=>$url ], 200 );

    }
}
