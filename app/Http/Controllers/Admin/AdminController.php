<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Session;
use App\Models\Banner;
use App\Models\BookParkingModel;



use App\Models\User;
use Carbon;
use DB;
use DateTime;

class AdminController extends Controller {
    // public function __construct()
    // {
    //     $this->middleware('auth:web', ['except' => ['adminlogin']]);
    // }
    public function dashboard() {
        return view( 'admin.dashboard' );

    }

    public function login() {
        // dd("login succeeful");
        return view( 'auth.login' );
    }

    public function home123(){
        // dd('hoem page');
        $data= Session::get('islogin');
        if(!$data){
            return redirect('admin/login');
        }
    }
    public function getvendor() {
        $data= Session::get('islogin');
        if(!$data){
            return redirect('admin/login');
        }

  
     
        
        $vendor=DB::table('users')->where('is_admin',2)->paginate(20);
        //dd($vendor);
        //return $vendor;
        return view('admin.layouts.vendor.vendor',compact('vendor'));
    }

    public function adminlogin( Request $request ) {

        // dd( $req );
        $request->validate( [
            'email' => 'required',
            'password' => 'required',
        ] );

        $credentials = $request->only( 'email', 'password' );
            //dd($credentials);
        $token = JWTAuth::attempt( $credentials, [ 'exp' => Carbon\Carbon::now()->addDays( 60 )->timestamp ] );
        //dd(Auth::attempt( $credentials, [ 'exp' => Carbon\Carbon::now()->addDays( 60 )->timestamp ] ));
        
        if($token){
            if ( JWTAuth::user()->is_admin == 1 ) {
                Session::put('islogin', true);
                return redirect('/admin/vendor');

            }else{
            return redirect( '/admin/login' )->with( 'error', 'You Are Not Admin' );
        }

    }
        else{ 
            // dd(Auth::user()->is_admin == 1);
            return redirect( '/admin/login' )->with( 'error', "Credential didn't match" );

        } 
        // return redirect()->route( 'Vendor' );
    }

    public function register() {
        return view( 'admin.register' );
    }

    public function bcbranch() {
        $data= Session::get('islogin');
        if(!$data){
            return redirect('admin/login');
        }
        $users=DB::table('bc_branch')->get();
        
    
        return view('admin.layouts.bcbranch.bcbranch',["banners"=>$users]);
    
    }
    public function banners() {
        $data= Session::get('islogin');
        if(!$data){
            return redirect('admin/login');
        }
        $users=DB::table('banners')->get();
        $videos=DB::table('videoclip')->get();
    
          return view('admin.layouts.banners.banner',["banners"=>$users,"videoclip"=>$videos]);
      
    }
    public function cancelorders() {
        $data= Session::get('islogin');
        if(!$data){
            return redirect('admin/login');
        }
        $orders=DB::table('book_parking')->orderBy("id", "desc")->where('parking_status',4)->where('is_cacnceled',0)->join('payments','book_parking.payment_id','=','payments.id')->select('book_parking.*','payments.pay_price')
        ->paginate(30);
    
    
    
    
    
        return view('admin.layouts.cancel.cancel',["orders"=>$orders]);
    
    }

    public function getuser() {
        $data= Session::get('islogin');
        if(!$data){
            return redirect('admin/login');
        }
        $users=DB::table('users')->where('is_admin',0)->paginate(10);
        return view('admin.layouts.users.users',["users"=>$users]);
    
    }
    public function helpandsupport() {
        $data= Session::get('islogin');
        if(!$data){
            return redirect('admin/login');
        }
        $support=DB::table('helpandsupport')->orderBy("id", "desc")->paginate(20);
    
    
    
    
    
        return view('admin.layouts.help.help',["support"=>$support]);
    
    }
    public function transcation() {
        $data= Session::get('islogin');
        if(!$data){
            return redirect('admin/login');
        }
        $trans=DB::table('payments')->join('users','payments.pay_user_id','=','users.id')
        ->orderBy('id','desc')->select("payments.*",'users.name')
        ->paginate(80);
        $total_price1=DB::table('payments')->where('pay_paysta_status_id',7)->sum('pay_price');
        $total_price2=DB::table('payments')->where('pay_paysta_status_id',6)->sum('pay_price');

        $total_price=$total_price1-$total_price2;
        return view('admin.layouts.payment.payment',["trans"=>$trans,"total_price"=>$total_price]);
    }

    public function support( Request $request ) {
        $data = DB::table( 'helpandsupport' )->insert( [
            'name'=>$request->input( 'name' ),
            'email'=>$request->input( 'email' ),
            'phonenumber'=>$request->input( 'phonenumber' ),
            'message'=>$request->input( 'message' )

        ] );
        return redirect( '/help/all' )->with( 'Sucess', 'Administrator will contact soon' );
    }

    public function password() {
        return view( 'admin.password' );
    }

    public function welcome( Request $request ) {

        return response()->json( $token );

    }
    public function verifyvendor( $id ) {

        $user=DB::table('users')->where('id',$id)->update([
            'users_isverified'=>1
        ]);

        return redirect('admin/getvendordetailstoadminbyid'.'/'.$id);

    }
    public function deactivatevendor( $id ) {

        $user=DB::table('users')->where('id',$id)->update([
            'users_isactive'=>1
        ]);
        $useraddress=DB::table('addresses')->where('add_user_id',$id)->update([
            'is_cloud_parking'=>0
        ]);

        return redirect('/admin/vendor');

    }
    public function activatevendor( $id ) {

        $user=DB::table('users')->where('id',$id)->update([
            'users_isactive'=>0
        ]);
        $useraddress=DB::table('addresses')->where('add_user_id',$id)->update([
            'is_cloud_parking'=>1
        ]);

        return redirect('/admin/vendor');

    }
    public function allbookings(  ) {

        $details=BookParkingModel::
        with('user_details')->
        with('address_details')
        ->with('booking_payment_details')
        ->with('parking_charge_details')
        ->with('all_parking_charge_details')
        ->with('parking_slot_address_details')
        ->orderBy('id','desc')
        
      
        ->paginate(15);
        // dd($details);

        return view('admin.layouts.booking.allbooking',compact('details'));

    }
    public function makeuseriactive( $id ) {

        $user=DB::table('users')->where('id',$id)->update([
            'users_isdeleted'=>1
        ]);

        return redirect('/admin/users');

    }
    public function makeuseractive( $id ) {

        $user=DB::table('users')->where('id',$id)->update([
            'users_isdeleted'=>0
        ]);

        return redirect('/admin/users');

    }

    public function getalltrancationforadmin() {
        $data= Session::get('islogin');
        if(!$data){
            return redirect('admin/login');
        }
        $trans = DB::table( 'payments' )->orderBy( 'id', 'asc' )->paginate( 80 );
        $total_price = DB::table( 'payments' )->sum( 'pay_price' );

        return view( 'admin.password', [ 'trans'=>$trans, 'total_price'=>$total_price ] );
    }
    public function destroy( Request $request,$id ) {
    
        $data = Banner::find($id )->delete();
      
        //$d = DB::table( 'banners' )->get();
        // return $d;

        return redirect('admin/banner');
    }
    public function destroyclip( $id ) {
        $data = DB::table('videoclip')->where('id',$id)->delete();

        //$d = DB::table( 'banners' )->get();
        // return $d;

        return redirect('admin/banner');
    }

    public function addBannerbyadmin(Request $request){
        $files=$request->file('banner_image_url');
        $hostname=$_SERVER['HTTP_HOST'];
        
                $filejustname =pathinfo($files, PATHINFO_FILENAME);
                // Get just extension of user upload file
                $extention =$files->getClientOriginalExtension();
                $fileName = $filejustname .time()."." .$extention ;
                $destinationPath = public_path().'/images'.'/banners';
                $fileupload=$files->move($destinationPath,$fileName);
                $banner_url=env('APP_URL').'/images'.'/banners'.'/'.$fileName; 

        $users=DB::table('banners')->insert([
            "banner_image_url"=>$banner_url,
   "banner_descprition"=>$request->input('banner_descprition')


        ]);
       



        return redirect('admin/banner');


    }

    public function addvideobyadmin(Request $request){
        $files=$request->file('clip_url');
        $hostname=$_SERVER['HTTP_HOST'];
        
                $filejustname =pathinfo($files, PATHINFO_FILENAME);
                // Get just extension of user upload file
                $extention =$files->getClientOriginalExtension();
                $fileName = $filejustname .time()."." .$extention ;
                $destinationPath = public_path().'/images'.'/banners';
                $fileupload=$files->move($destinationPath,$fileName);
                $banner_url=env('APP_URL').'/images'.'/banners'.'/'.$fileName; 

        $users=DB::table('videoclip')->insert([
            "clip_url"=>$banner_url,
 


        ]);
         return redirect('admin/banner');


    }


    public function getvendordetailstoadmin() {
        $data= Session::get('islogin');
        if(!$data){
            return redirect('admin/login');
        }
        $vendor = DB::table( 'users' )->where( 'is_admin', 2 )->orderBy( 'id', 'asc' )->paginate( 80 );

        return view( 'admin.password', [ 'vendor'=>$vendor ] );
    }

    public function getvendordetailstoadminbyid($id) {
        $vendor = DB::table( 'users' )->where( 'id', $id)->get();
        $vendor_account = DB::table( 'vendor_account' )->where( 'vendor_id', $id)->get();
        $vendor_kyc = DB::table( 'vendor_new_kyc' )->where( 'user_id', $id)->get();
        $vendor_id=$id;



        return view( 'admin.layouts.vendor.vendorview', [ 'vendor'=>$vendor,"account_details"=>$vendor_account,"kyc"=>$vendor_kyc,"id"=>$vendor_id ] );
    }

    public function returnamout( $id, $booking_id, $price ) {
        $date = new DateTime();
        $trans = "{{$date->format(\DateTime::ISO8601)}}".$id.$price;

        try {

            $payment = DB::table( 'payments' )->insert( [
                'pay_price'=>$price,
                'pay_user_id'=>$id,
                'pay_description'=>'refund amount',
                'pay_transaction_id'=>$trans,
                'pay_paysta_status_id'=>'6',
                'pay_method'=>'2',

            ] );

            $booking = DB::table( 'book_parking' )->where( 'id', $booking_id )->update( [ 'is_cacnceled'=>1 ] );

            $wallet = DB::table( 'wallet_parking' )
            ->insert( [
                'wal_user_id'=>$id,
                'wal_transaction_id'=>0,
                'credited_amt'=>$price
            ] );

            return redirect( 'admin/cancel/orders' );
        } catch( e ) {
            return dd( e );
        }
    }

    public function clearamout( $booking_id ) {

        $booking = DB::table( 'book_parking' )->where( 'id', $booking_id )->update( [ 'is_cacnceled'=>1 ] );

        return redirect( 'admin/cancel/orders' );
    }

    public function getvendoraccountdetailstoadmin( Request $req ) {
        $acct_vendor = VendorAccounts::where( 'vendor_id', '=', $req->input( 'user_id' ) )->get();

        return view( 'admin.password', [ 'acct_vendor'=>$acct_vendor ] );
    }

    public function addbcbranch( Request $req ) {
        $acct_vendor = DB::table( 'bc_branch' )->insert( [
            'name'=>$req->input( 'name' ),
            'address'=>$req->input( 'address' ),
            'add_lat'=>$req->input( 'add_lat' ),
            'add_lon'=>$req->input( 'add_lon' ),
            'bc_type'=>$req->input( 'bc_type' ),

        ] );

        return redirect( 'admin/bcbranch' );
    }

    public function deletebcbranch( $id ) {

        $acct_vendor = DB::table( 'bc_branch' )->where( 'id', $id )->delete();

        return redirect( 'admin/bcbranch' );
    }

}

