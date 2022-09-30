<?php

namespace App\Http\Controllers\API\User\cloudparking;
use App\Models\user_vehicle_documents;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class User_documentController extends Controller {
    public function addUserVehicleDocuments( Request $request ) {
        $files = $request[ 'driving_licence_path' ];
        $hostname = $_SERVER[ 'HTTP_HOST' ];

//<<<<<<< ashwini
class User_documentController extends Controller
{
//adding user vehicle documents details
    public function addUserVehicleDocuments(Request $request){
        $files=$request['driving_licence_path'];
        $hostname=$_SERVER['HTTP_HOST'];
        
                $filejustname =pathinfo($files, PATHINFO_FILENAME);
                // Get just extension of user upload file
                $extention =$files->getClientOriginalExtension();
                $fileName = $filejustname .time() ."." .$extention ;
                $destinationPath = public_path().'/images'.'/driving_licence';
                $fileupload=$files->move($destinationPath,$fileName);
                $dl_image=env('APP_URL').'/images'.'/driving_licence'.'/'.$fileName; 
//=======
//        $filejustname = pathinfo( $files, PATHINFO_FILENAME );
        // Get just extension of user upload file
 //       $extention = $files->getClientOriginalExtension();
  //      $fileName = $filejustname .time() .'.' .$extention ;
  //      $destinationPath = public_path().'/images'.'/driving_licence';
   //     $fileupload = $files->move( $destinationPath, $fileName );
   //     $dl_image = env( 'APP_URL' ).'/images'.'/driving_licence'.'/'.$fileName;
//>>>>>>> main

        $files = $request[ 'registration_certificate_path' ];
        $hostname = $_SERVER[ 'HTTP_HOST' ];
        $filejustname = pathinfo( $files, PATHINFO_FILENAME );
        // Get just extension of user upload file
        $extention = $files->getClientOriginalExtension();
        $fileName = $filejustname .time() .'.' .$extention ;
        $destinationPath = public_path().'/images'.'/registration_certificate';
        $fileupload = $files->move( $destinationPath, $fileName );
        $rc_image = env( 'APP_URL' ).'/images'.'/registration_certificate'.'/'.$fileName;

        $files = $request[ 'aadhar_card_path' ];
        $hostname = $_SERVER[ 'HTTP_HOST' ];
        $filejustname = pathinfo( $files, PATHINFO_FILENAME );
        // Get just extension of user upload file
        $extention = $files->getClientOriginalExtension();
        $fileName = $filejustname .time() .'.' .$extention ;
        $destinationPath = public_path().'/images'.'/aadhar_card';
        $fileupload = $files->move( $destinationPath, $fileName );
        $aadhar_image = env( 'APP_URL' ).'/images'.'/aadhar_card'.'/'.$fileName;

        $userdetails = Auth::user();

//<<<<<<< ashwini
                  $files=$request['aadhar_card_path'];
                  $hostname=$_SERVER['HTTP_HOST'];
                          $filejustname =pathinfo($files, PATHINFO_FILENAME);
                          // Get just extension of user upload file
                          $extention =$files->getClientOriginalExtension();
                          $fileName = $filejustname .time() ."." .$extention ;
                          $destinationPath = public_path().'/images'.'/aadhar_card';
                          $fileupload=$files->move($destinationPath,$fileName);
                    $aadhar_image=env('APP_URL').'/images'.'/aadhar_card'.'/'.$fileName;    
                    

        $user= Auth::user();  
      //dd($userdetails->id);
            $userdetails=new user_vehicle_documents;
            $userdetails->user_vehicle_id=$request->input('user_vehicle_id');
            $userdetails->user_id=(int)$user->id;
            $userdetails->driving_licence_path =json_encode($dl_image);
            $userdetails->registration_certificate_path=json_encode($rc_image);
            $userdetails->aadhar_card_path=json_encode($aadhar_image);
            $userdetails-> save();
            return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);
    }
    

//editing user vehicle documents
    public function editUserVehicleDocuments(Request $request){
        $files=$request['driving_licence_path'];
        $hostname=$_SERVER['HTTP_HOST'];
        
                $filejustname =pathinfo($files, PATHINFO_FILENAME);
                // Get just extension of user upload file
                $extention =$files->getClientOriginalExtension();
                $fileName = $filejustname .time() ."." .$extention ;
                $destinationPath = public_path().'/images'.'/driving_licence';
                $fileupload=$files->move($destinationPath,$fileName);
                $dl_image=env('APP_URL').'/images'.'/driving_licence'.'/'.$fileName; 


                $files=$request['registration_certificate_path'];
                $hostname=$_SERVER['HTTP_HOST'];
                        $filejustname =pathinfo($files, PATHINFO_FILENAME);
                        // Get just extension of user upload file
                        $extention =$files->getClientOriginalExtension();
                        $fileName = $filejustname .time() ."." .$extention ;
                        $destinationPath = public_path().'/images'.'/registration_certificate';
                        $fileupload=$files->move($destinationPath,$fileName);
                  $rc_image=env('APP_URL').'/images'.'/registration_certificate'.'/'.$fileName; 


                  $files=$request['aadhar_card_path'];
                  $hostname=$_SERVER['HTTP_HOST'];
                          $filejustname =pathinfo($files, PATHINFO_FILENAME);
                          // Get just extension of user upload file
                          $extention =$files->getClientOriginalExtension();
                          $fileName = $filejustname .time() ."." .$extention ;
                          $destinationPath = public_path().'/images'.'/aadhar_card';
                          $fileupload=$files->move($destinationPath,$fileName);
                    $aadhar_image=env('APP_URL').'/images'.'/aadhar_card'.'/'.$fileName;    
                    

      $user= Auth::user();  
                    //dd($userdetails->id);
     $userdetails=new user_vehicle_documents;
       //dd($userdetails->id=);
       $data=DB::table('user_vehicle_documents')->where('user_vehicle_documents.user_id','=',$user->id)->update(['user_vehicle_id'=>$request->input('user_vehicle_id'),'driving_licence_path'=>json_encode($dl_image),'registration_certificate_path'=>json_encode($rc_image),'aadhar_card_path'=>json_encode($aadhar_image)]);
            return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);
    }

    


    public function getUserVehicleDocuments(Request $request)
  {  
//=======
//        $userdetails = new user_vehicle_documents;
 //       $userdetails->user_vehicle_id = $request->input( 'user_vehicle_id' );
 //       $userdetails->user_id = $request->input( 'user_id' );
 //       $userdetails->driving_licence_path = json_encode( $dl_image );
 //       $userdetails->registration_certificate_path = json_encode( $rc_image );
 //       $userdetails->aadhar_card_path = json_encode( $aadhar_image );
  //      $userdetails-> save();
  //      return response()->json( [ 'status'=>'Sucess', 'message'=>'Deatils uploaded sucessfully' ], 200 );
  //  }
//>>>>>>> main

    public function getUserVehicleDocuments( Request $request ) {

        $userdetails = Auth::user();

        //  dd( $userdetails->id );

        $res = DB::table( 'user_vehicle_documents' )->leftjoin( 'users', 'user_vehicle_documents.user_id', '=', 'users.id' )
        ->leftjoin( 'user_vehicle', 'user_vehicle_documents.user_id', '=', 'user_vehicle.useveh_user_id' )
        ->where( 'users.is_admin', '=', 3 )
        ->where( 'users.id', '=', $userdetails->id )
        ->select( 'users.id', 'users.name', 'users.email', 'users.phonenumber', 'users.is_admin', 'user_vehicle.useveh_vehicle_name', 'user_vehicle.useveh_vehicle_number', 'user_vehicle_documents.driving_licence_path', 'user_vehicle_documents.registration_certificate_path', 'user_vehicle_documents.aadhar_card_path' )
        ->get();

        return response()->json( [ 'User Vehicle Documents details'=>$res ], 200 );

    }
}