<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Sms;
use Illuminate\Support\Facades\Session;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Laravel\Socialite\Facades\Socialite;


use App\Http\Requests\Validation\LoginRequest;
use App\Http\Requests\Validation\RegisterRequest;
// Validation/RegisterRequest

use App\Connectors\ThirdParty\SmsConnector;
// use App\Connectors\ThirdParty\SmsConnector;
use App\Http\Controllers\Utils\Utils;

use Config;




class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => [
            'login','register','request_otp','redirectToGoogle','handleGoogleCallback',
            ]]);
    }
    public function login(LoginRequest $request)
    {   
        $credentials = $request->only('email', 'password');

   

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 410);
        }

        $user = Auth::user();
        Session::put('user',['token'=>$token,'user'=>$user]);

        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

    }

    public function request_otp(RegisterRequest $request)
    {
      

            $smsConnectorInstance = new SmsConnector();
            $msgType="Register";
            $otp = rand(100000, 999999);
             $mobile ='+91' . $request->input('phonenumber');
             $templates = Config::get('constants.MSG_TEMPLATES');
	         $msg = $templates[$msgType][0].$otp.$templates[$msgType][1];
             $result = $smsConnectorInstance->sendSms($mobile, $msg);
        if($result){
        Session::put('user', [
            'email'    => $request->input('email'),
            'name'=>$request->input('name'),
            'password'   => $request->input('password'),
            'phonenumber' => $request->input('phonenumber'),
            // 'email_verified_at'=>$request->input('email_verified_at'),
            'device_token'=>$request->input('device_token'),
            // 'two_factor_secret'=>$request->input('two_factor_secret'),
            // 'two_factor_recovery_codes'=>$request->input('two_factor_recovery_codes'),
            // 'remember_token'=>$request->input('remember_token'),
            // 'user_google_id'=>$request->input('user_google_id'),
            // 'user_google_type_id'=>$request->input('user_google_type_id'),
            'is_admin'=>$request->input('is_admin'),
            'user_isverified'=>$request->input('user_isverified'),
            'user_isactive'=>$request->input('user_isactive'),
            'users_isdeleted'=>$request->input('users_isdeleted'),
            'otp' => $otp,
            'session_id' => Session::getId()
        ]);
        $smsLog = new Sms();
	    $smsLog->tsl_phonenumber=$mobile;
	    $smsLog->tsl_otp = $otp;
	    $smsLog->tsl_type = '1';
	    $smsLog->tsl_msg = $msg;
	    $smsLog->tsl_issent = "1";
	// $smsLog->tsl_issent = $result;
//<<<<<<< tejashwinirm
//	$smsLog->save();


       
           

   
     //       return ['message' => $result, 'success' => 1,'otp'=>$otp];

     //   }
        // catch (\Exception $e) 
      //  {
            // dd($e);
       //     return response()->json( [
         //           'entity' => 'users', 
          //          'action' => 'create', 
         //           'status' => 'failed'
          //  ], 409);
       // }
 //       return ['message' => 'Something went wrong', 'success' => 0,];
//=======
	    $smsLog->save();
            return ['message' => $result, 'success' => 1,]; 
//>>>>>>> backup
    }
    return ['message' => 'Something went wrong', 'success' => 0,];

       

    
         
      
    }

    public function register(Request $request){

        // if(Session::has('user')){
        if(Session::get('user.otp') == $request->input('otp')){          
           $password= Session::get('user.password');
           $email= Session::get('user.email');
           $name= Session::get('user.name');  
           $phonenumber = Session::get('user.phonenumber');
           $user =  new User;
          $user->name=$name;
          $user->phonenumber=$phonenumber;
          $user->email=$email;
          $user->password=app('hash')->make($password);
        //   $user->email_verified_at=Session::get('user.email_verified_at');
          $user->device_token=Session::get('user.device_token');
        //   $user->two_factor_secret=Session::get('user.two_factor_secret');
        //   $user->two_factor_recovery_codes=Session::get('user.two_factor_recovery_codes');
        //   $user->remember_token=Session::get('user.remember_token');
        //   $user->user_google_id=Session::get('user.user_google_id');
        //   $user->user_google_type_id=Session::get('user.user_google_type_id');
          $user->is_admin=Session::get('user.is_admin');
          $user->users_isverified=Session::get('user.user_isverified');
          $user->users_isactive=Session::get('user.user_isactive');
          $user->users_isdeleted=Session::get('user.users_isdeleted');
          $user->save();
          if($user){
            $token = Auth::attempt([
               'email'=> $email,
               'password'=>
               $password]);

               Session::put('user',['token'=>$token,'user'=>$user]);
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
          }
        }else{
            return response()->json([
                'status' => 'falied',
                'message' => "Otp didn't match", 
            ]);
        }
    // }
        // return response()->json([
        //     'status' => 'failed',
        //     'message' => 'User Not created ',
           
        // ],405);  
    }


    public function logout(Request $request)
    {
        if(Auth::user()){

        Auth::invalidate(Auth::getToken());
        Session::flush();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ])
        ;}else{

            return response()->json([
                'status' => 'failed',
                'message' => 'user not found',
            ])
            ;

        }
        
    }


    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
        // return Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return JsonResponse
     */

    public function handleGoogleCallback()
    {
        $GoogleUser = Socialite::driver('google')->stateless()->user();
        $user = Oc_customer::query()->firstOrNew(['email' => $GoogleUser->getEmail()]);

        if (!$user->exists) {
            $user->email = $GoogleUser->getEmail();
            $user->google_id = $GoogleUser->getID();
            $user = $user->save();
        }

         $token = JWTAuth::fromUser($user);
         
         return new JsonResponse([
              'token' => $token,
              'provider' => 'Google',
              'status' => 'success'
         ]);
         
    }

    public function refresh()
    {

// dd(Auth::user());

if(Auth::user()){
Session::put('user',['token'=>Auth::refresh()]);
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }else{
        return response()->json(['status'=>'failed','message'=>'unauthorized']);
    }
}}
