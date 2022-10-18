<?php

namespace App\Http\Controllers\API\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;
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

      $files=$request['profile_photo_path'];
      $hostname=$_SERVER['HTTP_HOST'];
      
              $filejustname =pathinfo($files, PATHINFO_FILENAME);
              // Get just extension of user upload file
              $extention =$files->getClientOriginalExtension();
              $fileName = $filejustname .time() ."." .$extention ;
              $destinationPath = public_path().'/images'.'/profile';
              $fileupload=$files->move($destinationPath,$fileName);
              $profile_image=env('APP_URL').'/images'.'/profile'.'/'.$fileName; 


       


      $details_update=DB::table('users')->where('id','=',$user->id)
      
      ->update([
        'profile_photo_path'=>$profile_image]
      );

        return response()->json( [ 'message'=>'Profile image uploaded sucessfully' ], 200 );


    }
    public function updateUser(Request $request) {
      //checking if users exists or not
      $user = Auth::user();

      $users = User::find($user->id);
  
      if($users === null) {
        return ['message' => 'Invalid User', 'success' => 0];
      }
  
      if( User::where('phonenumber', '=', $request->input('phonenumber'))
        ->where('id', '!=', $user->id)
        ->exists() ) {
        return ['message' => 'phonenumber already used', 'success' => 0];
      }
  
      if( User::where('email', '=',  $request->input('email'))
        ->where('id', '!=', $user->id)
        ->exists()) {
  
        return ['message' => 'Email already used', 'success' => 0];
      }
      $users->name=$request->input('name');
      $users->email=$request->input('email');
      $users->phonenumber=$request->input('phonenumber');
      $users->save();
          
      return ['message' => 'User details successfully updated', 'success' => 1];
  
    }
}
