<?php

namespace App\Http\Controllers\API\profile;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Sms;
use Carbon;
use Illuminate\Support\Facades\Session;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Laravel\Socialite\Facades\Socialite;

use App\Http\Requests\Validation\LoginRequest;
use App\Http\Requests\Validation\RegisterRequest;
// Validation/RegisterRequest

use App\Connectors\ThirdParty\SmsConnector;
// use App\Connectors\ThirdParty\SmsConnector;
use App\Http\Controllers\Utils\Utils;
use App\Http\Requests\Validation\ProfileRequest;


use Config;
use DB;
use Illuminate\Support\Facades\Storage;

class Profile extends Controller {
    public function getprofile( Request $request ) {
        $user = Auth::user();

        $get_user_details =  DB::table( 'users' )->where( 'id', '=', $user->id )
        ->select( 'name', 'email', 'phonenumber', 'profile_photo_path' ,'users_isverified','users_isdeleted')
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
      }else if($users->phonenumber!=$request->input('phonenumber')){
          $user_number = User::where('phonenumber', '=', $request->input('phonenumber'))->first();
if ($user_number != null) {
   return response()->json ([ 'message' => 'Number already exits', 'success' => 0, ],412);
}
        
      $smsConnectorInstance = new SmsConnector();
      $msgType = 'Update';
      $otp = rand( 100000, 999999 );
      $mobile = '+91' . $request->input( 'phonenumber' );
      $templates = Config::get( 'constants.MSG_TEMPLATES' );
      $msg = $templates[ $msgType ][ 0 ].$otp.$templates[ $msgType ][ 1 ];
      $result = $smsConnectorInstance->sendSms( $mobile, $msg );
      if ( $result ) {

        $smsLog = new Sms();
        $smsLog->tsl_phonenumber = $mobile;
        $smsLog->tsl_otp = $otp;
        $smsLog->tsl_type = '1';
        $smsLog->tsl_msg = $msg;
        $smsLog->tsl_issent = '1';
        $smsLog->save();
        if($smsLog){
        return response()->json([

            'message'   => 'Sucess',
            'otp'=>$otp,

            'status' => $result, 'success' => 1, ],200);

        }}else
        return response()->json([ 'message' => 'Something went wrong', 'success' => 0, ],412);



      }
  
    
      $users->name=$request->input('name');
      $users->email=$request->input('email');
      // $users->phonenumber=$request->input('phonenumber');
      $users->save();
          
      return ['message' => 'User details successfully updated', 'success' => 1];
  
    }

    
    public function updatemobilenumberbyotp(Request $request ) {


      $user = Auth::user();
      

      $users = User::find($user->id);
      $users->name=$request->input('name');
      $users->email=$request->input('email');
      $users->phonenumber=$request->input('phonenumber');
      
      $users->save();
          return response()->json( [
                        'status' => 'success',
                        'message' => 'User updated successfully',
                       
                    ] ,200);

     

      }
      public function editProfile(Request $request ) {
       
        $mobile = '+91' . $request->input( 'phonenumber' );

        $otp = Sms::where( 'tsl_phonenumber', '=', $mobile )
        ->orderBy('id', 'desc')
        ->first('tsl_otp');

      //   dd();

        if ($otp->tsl_otp == $request->input( 'otp' ) ) {
          
          $user = Auth::user();
       $data=DB::table('users')
       ->where('id','=',$user->id)
       ->update(['users.password'=> bcrypt($request->input('password')),'email'=>$request->input('email')]);
          
           if(true)
                    return response()->json( [
                        'status' => 'success',
                        'message' => 'User updated successfully',
                       
                    ] );
                
            } else {
                return response()->json( [
                    'status' => 'falied',

                    'message' => "Otp didn't match",
                ],412 );
            }

        }

}
