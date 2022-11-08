<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
        
    }
    
    public function login(){
        return view('admin.login');
    }

    public function register(){
        return view('admin.register');
    }
    
    public function password(){
        return view('admin.password');
    }
    public function welcome(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
 
        $credentials = $request->only( 'email', 'password' );

        $token = Auth::attempt( $credentials,['exp' => Carbon\Carbon::now()->addDays(60)->timestamp] );
        if ( !$token ) {
            return view('admin.dashboard');
        }
        return response()->json($token); 
    }
}

