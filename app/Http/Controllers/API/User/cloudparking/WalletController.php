<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WalletModel;
use DB;


class WalletController extends Controller
{
    public function updateWallet(Request $request){
        $WalletModel=new WalletModel();
        $WalletModel->wal_user_id=$request->wal_user_id;
        $WalletModel->wal_balance='0';
        $WalletModel->wal_transaction_id=$request->wal_transaction_id;
        $WalletModel->credited_amt=$request->credited_amt;
        $WalletModel->debited_amt=$request->debited_amt;
       
        if($request->credited_amt){
            $WalletModel->wal_balance=$WalletModel->wal_balance+$request->credited_amt;
            return  $WalletModel->wal_balance;
            $res=$WalletModel->save();
            return $res;
        }

    }

    public function walletDetails(Request $request)
    {
        $data=WalletModel::find($request->input('id'));
        return response()->json(["wallet details"=>$data],200);
    }

     public function updatingeWallet(Request $request){

    

        $data=DB::table('wallet')
        ->leftjoin('users','wallet.wal_user_id','=','users.id')
        ->select('users.id','wal_balance','credited_amt','debited_amt')->get();
        //->update(['wallet.wal_balance','=','wallet.wal_balance','-','$request->debited_amt'])->get();
        return $data;
        }


/*

       $data=DB::table('wallet')
      
       ->where('wallet.wal_user_id','=',$request->id)
      
       ->get();
      
        return response()->json([$data]);
    }
    */

     }

