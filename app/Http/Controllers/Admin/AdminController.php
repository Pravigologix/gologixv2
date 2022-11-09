<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon;
use DB;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
        
    }
    
    public function login(){
        return view('auth.login');
    }
    public function adminlogin(Request $request){

        // dd($req);
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
 
        $credentials = $request->only( 'email', 'password' );

        $token = Auth::attempt( $credentials,['exp' => Carbon\Carbon::now()->addDays(60)->timestamp] );
        if ( !$token ) {
       
            return redirect('/')->with('error',"Credential didn't match");
        }
        else if(Auth::user()->is_admin==1){
        return view('admin.dashboard');

           
        }else{
    
            return redirect('/')->with('error',"You Are Not Admin");
     

    }
    }

    public function register(){
        return view('admin.register');
    }
    
    public function password(){
        return view('admin.password');
    }
    public function welcome(Request $request){
       
        return response()->json($token); 
    }


    public function getalltrancationforadmin(){
        $trans=DB::table('payments')->orderBy('id','asc')->paginate(80);
        $total_price=DB::table('payments')->sum('pay_price');






        return view('admin.password',["trans"=>$trans,"total_price"=>$total_price]);
    }

    public function getvendordetailstoadmin(){
        $vendor=DB::table('users')->where('is_admin',2)->orderBy('id','asc')->paginate(80);
        






        return view('admin.password',["vendor"=>$vendor]);
    }
    public function getvendoraccountdetailstoadmin(Request $req){
        $acct_vendor=VendorAccounts::where('vendor_id','=',$req->input('user_id'))->get();
        






        return view('admin.password',["acct_vendor"=>$acct_vendor]);
    }

}

