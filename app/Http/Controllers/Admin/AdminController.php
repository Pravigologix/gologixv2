<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon;
use DB;
use DateTime;

class AdminController extends Controller {
    public function dashboard() {
        return view( 'admin.dashboard' );

    }

    public function login() {
        return view( 'auth.login' );
    }

    public function adminlogin( Request $request ) {

        // dd( $req );
        $request->validate( [
            'email' => 'required',
            'password' => 'required',
        ] );

        $credentials = $request->only( 'email', 'password' );

        $token = Auth::attempt( $credentials, [ 'exp' => Carbon\Carbon::now()->addDays( 60 )->timestamp ] );
        if ( !$token ) {

            return redirect( '/' )->with( 'error', "Credential didn't match" );
        } else if ( Auth::user()->is_admin == 1 ) {
            return redirect( '/vendor' );

        } else {

            return redirect( '/' )->with( 'error', 'You Are Not Admin' );

        }
    }

    public function register() {
        return view( 'admin.register' );
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

    public function getalltrancationforadmin() {
        $trans = DB::table( 'payments' )->orderBy( 'id', 'asc' )->paginate( 80 );
        $total_price = DB::table( 'payments' )->sum( 'pay_price' );

        return view( 'admin.password', [ 'trans'=>$trans, 'total_price'=>$total_price ] );
    }

    public function getvendordetailstoadmin() {
        $vendor = DB::table( 'users' )->where( 'is_admin', 2 )->orderBy( 'id', 'asc' )->paginate( 80 );

        return view( 'admin.password', [ 'vendor'=>$vendor ] );
    }

    public function getvendordetailstoadminbyid($id) {
        $vendor = DB::table( 'users' )->where( 'id', $id)->get();
        $vendor_account = DB::table( 'vendor_account' )->where( 'vendor_id', $id)->get();
        $vendor_kyc = DB::table( 'vendor_kyc' )->where( 'venkyc_vendor_id', $id)->get();



        return view( 'admin.vendorview', [ 'vendor'=>$vendor,"account_details"=>$vendor_account,"kyc"=>$vendor_kyc ] );
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
                'pay_paysta_status_id'=>'7',
                'pay_method'=>'2',

            ] );

            $booking = DB::table( 'book_parking' )->where( 'id', $booking_id )->update( [ 'is_cacnceled'=>1 ] );

            $wallet = DB::table( 'wallet_parking' )
            ->insert( [
                'wal_user_id'=>$id,
                'wal_transaction_id'=>0,
                'credited_amt'=>$price
            ] );

            return redirect( '/cancel/orders' );
        } catch( e ) {
            return dd( e );
        }
    }

    public function clearamout( $booking_id ) {

        $booking = DB::table( 'book_parking' )->where( 'id', $booking_id )->update( [ 'is_cacnceled'=>1 ] );

        return redirect( '/cancel/orders' );
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

        return redirect( '/bcbranch' );
    }

    public function deletebcbranch( $id ) {

        $acct_vendor = DB::table( 'bc_branch' )->where( 'id', $id )->delete();

        return redirect( '/bcbranch' );
    }

}

