<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WalletModel;
use DB;


class WalletController extends Controller
{
    public function addwalletamount(Request $request){

      

        
        $walletModel=new WalletModel();
        $walletModel->wal_user_id=$request->input('user_id');
      

        $walletModel->wal_transaction_id=$request->input('wal_transaction_id');
        $walletModel->credited_amt=$request->input('credited_amt');
        $walletModel->debited_amt=$request->input('debited_amt');

        $walletModel->save();

        

       

    }

    public function getwalletamount(Request $request){

      

        
        $walletModel=WalletModel()::where('wal_user_id',$request->input('user_id'))->get;
        $walletModel->wal_user_id=$request->input('user_id');
      

        $walletModel->wal_transaction_id=$request->input('wal_transaction_id');
        $walletModel->credited_amt=$request->input('credited_amt');
        $walletModel->debited_amt=$request->input('debited_amt');

        $walletModel->save();

        

       

    }

    

    




     }

