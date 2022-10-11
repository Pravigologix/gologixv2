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
        
         $order=DB::table('orders')->insert([
            'ord_refid'=>Str::random(30000),
            'ord_user_id'=>$userdetails->id,

            'ord_status_id'=>$request->input('ord_status_id'),
            'ord_payment_status_id'=>$request->input('ord_payment_status_id'),
            'ord_paymethod_id'=>$request->input('ord_paymethod_id'),
            'ord_delivery_address_id'=>$request->input('ord_delivery_address_id')
           


        ]);
        if($order){
            $orderid=DB::table('orders')
           
            ->where('ord_user_id','=',$request->input('user_id'))->first('id');

       

        $payment = DB::table( 'payments' )->insert( [
            'pay_price'=>$request->input( 'pay_price' ),
            'pay_user_id'=>$userdetails->id,
            // 'pay_description'=>$request->input( 'pay_description' ),
            'pay_description'=>$request->input( 'pay_description' ),

            //'pay_description'=>$request->input( 'pay_description' ),


            'pay_transaction_id'=>$request->input( 'pay_transaction_id' ),
            'pay_paysta_status_id'=>$request->input( 'pay_paysta_status_id' ),
            'pay_method'=>$request->input( 'pay_method' ),

         

            'pay_order_id'=>json_decode(json_encode($orderid),true),



       

        ] );

        $paymentid=DB::table('payments')
        ->where('pay_user_id','=',$request->input('user_id'),)
        ->where('pay_transaction_id','=',$request->input('pay_transaction_id'),)
        ->where('pay_order_id','=',son_decode(json_encode($orderid),true))->get('id');

        $walletModel = new WalletModel();
        // $walletModel->wal_user_id = $request->input( 'user_id' );
        $walletModel->wal_user_id = $userdetails->id;

      
        $walletModel->wal_transaction_id =(string)$paymentid;
        $walletModel->credited_amt = $request->input( 'credited_amt' );
        $walletModel->debited_amt = $request->input( 'debited_amt' );

        $walletModel->save();

        return response()->json( [ 'message'=>'payment Satus Updated' ], 200 );
    }

    }

    public function debitwalletamount( Request $request ) {

        // public function getwalletamount( Request $request ) {
        $userdetails = Auth::user();

        //$walletdetails = WalletModel::where( 'wal_user_id', $userdetails->id )->get();

        //$walletModel = WalletModel()::where( 'wal_user_id', $request->input( 'user_id' ) )->get;
        //$walletModel->wal_user_id = $request->input( 'user_id' );
        $credited_amt = WalletModel::where( 'wal_user_id', $userdetails->id )
        ->sum( 'credited_amt' );
        $debited_amt = WalletModel::where( 'wal_user_id', $userdetails->id )
        ->sum( 'debited_amt' );

        $balance = $credited_amt-$debited_amt;

        // dd();

      
        if ( $balance >= $request->input( 'debited_amt' ) ) {
            $walletModel = new WalletModel();
            $walletModel->wal_user_id = $userdetails->id;
            $walletModel->wal_transaction_id = $request->input( 'wal_transaction_id' );

            // $walletModel->wal_transaction_id = $payment->id;
            $walletModel->credited_amt = $request->input( 'credited_amt' );
            $walletModel->debited_amt = $request->input( 'debited_amt' );

            $walletModel->save();
            return response()->json( [ 'message'=>'Amount debited sucessfully', 'status'=>1 ], 200 );

        }
        return response()->json( [ 'message'=>'recharge amount insufficent wallet balance', 'status'=>0 ], 303 );

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

