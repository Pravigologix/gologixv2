<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class ProfileController extends Controller
{
    public function forgetPassword(Request $request)
	{
        
		$password=DB::table('users')
		         //->where('id','=',$request->input('id'))
				->where('email','=',$request->input('email'))
		        ->update(['users.password'=> bcrypt($request->input('password'))]);
		if($password){
			
			return["message"=>"User Updated password Successfully","success"=>1];
		}

			
		return["message"=>"Failed to update the password","success"=>0];

	}
}
