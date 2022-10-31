<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WalletModel;
use DB;
use Auth;
use Illuminate\Support\Str;

class WalletController extends Controller {

    public function addwalletamount( Request $request ) {

        $userdetails = Auth::user();
        
        $trans_id=(string)$request->input( 'pay_price' ).(string)$userdetails->id.'2022';
       
        $payment = DB::table( 'payments' )->insert( [
            'pay_price'=>$request->input( 'pay_price' ),
            'pay_user_id'=>$userdetails->id,
            'pay_description'=>$request->input( 'pay_description' ),
            'pay_transaction_id'=>$trans_id,
            'pay_paysta_status_id'=>$request->input( 'pay_paysta_status_id' ),
            'pay_method'=>$request->input( 'pay_method' ),
           
        ] );

        $paymentid=DB::table('payments')
        ->where('pay_user_id','=',$request->input('user_id'),)
//<<<<<<< branch4
    //    ->where('pay_transaction_id','=',$request->input('pay_transaction_id'),)
      //  ->where('pay_order_id','=',json_encode($orderid))->get('id');
//=======
        ->where('pay_transaction_id','=', $trans_id)
        ->get('id');
//>>>>>>> main

        $walletModel = new WalletModel();
        // $walletModel->wal_user_id = $request->input( 'user_id' );
        $walletModel->wal_user_id = $userdetails->id;

      
        $walletModel->wal_transaction_id =(string)$paymentid->id;
        $walletModel->credited_amt = $request->input( 'credited_amt' );
        $walletModel->debited_amt = $request->input( 'debited_amt' );
        $walletModel->wal_isactive =0;
        $walletModel->save();


        $wal_id=WalletModel::where('wal_transaction_id','=',(string)$paymentid)->where('credited_amt', $request->input( 'credited_amt' ))->get('id');

        return response()->json( [ 
            'payment_id'=>$paymentid,
            'wal_id'=>$wal_id,
          
            
            'message'=>'payment Satus Updated' ], 200 );
    

    }

    public function debitwalletamount( Request $request ) {

        $userdetails = Auth::user();
        $credited_amt = WalletModel::where( 'wal_user_id', $userdetails->id )
        ->sum( 'credited_amt' );
        $debited_amt = WalletModel::where( 'wal_user_id', $userdetails->id )
        ->sum( 'debited_amt' );

        $balance = $credited_amt-$debited_amt;
        if ( $balance >= $request->input( 'debited_amt' ) ) {
            $walletModel = new WalletModel();
            $walletModel->wal_user_id = $userdetails->id;
            $walletModel->wal_transaction_id = $request->input( 'wal_transaction_id' );
            $walletModel->credited_amt = $request->input( 'credited_amt' );
            $walletModel->debited_amt = $request->input( 'debited_amt' );
            $walletModel->save();
            return response()->json( [ 'message'=>'Amount debited sucessfully', 'status'=>1 ], 200 );

        }
        return response()->json( [ 
            
            
            'message'=>'recharge amount insufficent wallet balance', 'status'=>0 ], 412 );

    }
     public function updatewalletamount( Request $request ) {

        $wallet=DB::table('wallet')->where('id','=',$request->input( 'wallet_id'))->update(['wal_isactive'=>1]);

        
       
             $payment = DB::table( 'payments' )->where('id','=',$request->input( 'payment_id'))
                 ->update( [
            'pay_transaction_id'=>$request->input( 'trnas_id' ),
            'pay_paysta_status_id'=>$request->input( 'pay_paysta_status_id' ),
            'pay_method'=>$request->input( 'pay_method' ),
           
        ] );
            return response()->json( [ 'message'=>'Amount debited sucessfully', 'status'=>1 ], 200 );

        

    }

    public function getwalletamount( Request $request ) {

        $userdetails = Auth::user();
        $walletdetails = WalletModel::where( 'wal_user_id', $userdetails->id )->get();
        $credited_amt = WalletModel::where( 'wal_user_id', $userdetails->id )->where('wal_isactive','=',1)
        ->sum( 'credited_amt' );
        $debited_amt = WalletModel::where( 'wal_user_id', $userdetails->id )
        ->sum( 'debited_amt' );

        return response()->json( [
            'wallte_details'=>$walletdetails,
            'balance'=>$credited_amt-$debited_amt ], 200 );

        }
    }

