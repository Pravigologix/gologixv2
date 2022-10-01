<?php

namespace App\Http\Controllers\API\vendor\cloudparking;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Validation\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use DB;
use Session;


class SecurityController extends Controller
{
 
  public function securityRegister(RegisterRequest $request){
      
       $user=new User();
       $user->name=$request->name;
       $user->email=$request->email;
       $user->phonenumber=$request->phonenumber;
       $user->is_admin=6;
       $user->password=Hash::make($request->password);
       $password_confirmation= Session::get('password_confirmation');
       //$user->confirm_password=Hash::make($request->confirm_password);
      
       if($request->password==$request->password_confirmation){
        $res=$user->save();
        //return ["name"=>$request->name,"email"=>$request->email,"phone_no"=>$request->phone_no,"password"=>$request->password];
        return response()->json(['status'=>'Success','message'=>'Registered sucessfully'],200); 
   }
   else{
    return response()->json(['status'=>'fail','message'=>'Password not match'],301);    }
   
   }
   /*
public function securityLogin(Request $request){
  $request->validate([
    'email'=>'required|email',
    'password'=>'required|min:8|max:12'
   ]);
   $user=User::where('email','=',$request->email)->first();
   if($user){
    if(Hash::check($request->password,$user->password)){
        $request->session()->put('loginId',$user->id);
        return response()->json(['status'=>'Success','message'=>'Login done sucessfully'],200); 
    }else{
        return response()->json(['status'=>'fail','message'=>'Password not match'],300); 

    }

  }else{
    return response()->json(['status'=>'fail','message'=>'User not registered'],300); 
}
}*/
}