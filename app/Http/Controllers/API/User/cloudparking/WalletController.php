<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WalletModel;
use DB;
use Auth;

class WalletController extends Controller {

    public function addwalletamount( Request $request ) {

        $userdetails = Auth::user();

        $payment = DB::table( 'payments' )->insert( [
            'pay_price'=>$request->input( 'pay_price' ),
            'pay_user_id'=>$userdetails->id,
            'pay_description'=>$request->input( 'pay_description' ),
            'pay_transaction_id'=>$request->input( 'pay_transaction_id' ),
            'pay_paysta_status_id'=>$request->input( 'pay_paysta_status_id' ),
            'pay_method'=>$request->input( 'pay_method' ),

        ] );

        $walletModel = new WalletModel();
        $walletModel->wal_user_id = $request->input( 'user_id' );
        $walletModel->wal_user_id = $userdetails->id;

        $walletModel->wal_transaction_id = $request->input( 'wal_transaction_id' );
        $walletModel->wal_transaction_id = $payment->id;
        $walletModel->credited_amt = $request->input( 'credited_amt' );
        $walletModel->debited_amt = $request->input( 'debited_amt' );

        $walletModel->save();

        return response()->json( [ 'message'=>'payment Satus Updated' ], 200 );

    }

    public function debitwalletamount( Request $request ) {

        // public function getwalletamount( Request $request ) {
        $userdetails = Auth::user();

        $walletdetails = WalletModel::where( 'wal_user_id', $userdetails->id )->get();

        $walletModel = WalletModel()::where( 'wal_user_id', $request->input( 'user_id' ) )->get;
        $walletModel->wal_user_id = $request->input( 'user_id' );
        $credited_amt = WalletModel::where( 'wal_user_id', $userdetails->id )
        ->sum( 'credited_amt' );
        $debited_amt = WalletModel::where( 'wal_user_id', $userdetails->id )
        ->sum( 'debited_amt' );

        $balance = $credited_amt-$debited_amt;

        // dd();

        $walletModel->wal_transaction_id = $request->input( 'wal_transaction_id' );
        if ( $balance >= $request->input( 'debited_amt' ) ) {
            $walletModel = new WalletModel();
            $walletModel->wal_user_id = $userdetails->id;

            // $walletModel->wal_transaction_id = $payment->id;
            $walletModel->credited_amt = $request->input( 'credited_amt' );
            $walletModel->debited_amt = $request->input( 'debited_amt' );

            $walletModel->save();
            return response()->json( [ 'message'=>'Amount debited sucessfully', 'status'=>1 ], 200 );

        }
        return response()->json( [ 'message'=>'recharge amount insufficent wallet balance', 'status'=>0 ], 200 );

    }

    public function getwalletamount( Request $request ) {

        $userdetails = Auth::user();

        $walletdetails = WalletModel::where( 'wal_user_id', $userdetails->id )->get();

        $credited_amt = WalletModel::where( 'wal_user_id', $userdetails->id )
        ->sum( 'credited_amt' );
        $debited_amt = WalletModel::where( 'wal_user_id', $userdetails->id )
        ->sum( 'debited_amt' );

        return response()->json( [
            'wallte_details'=>$walletdetails,
            'balance'=>$credited_amt-$debited_amt ], 200 );

        }
    }

