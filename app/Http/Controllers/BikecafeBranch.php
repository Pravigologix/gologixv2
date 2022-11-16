<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BikecafeBranch extends Controller
{
    public function getallbcbranch(Request $req)
    {
        $bc_cafe=DB::table('bc_branch')->where('bc_type',0)->where('isactive',1)->get();
        $bc_ev=DB::table('bc_branch')->where('bc_type',1)->where('isactive',1)->get();

        return response()->json([
            "BC Cafe"=>$bc_cafe,
            "Bc_Ev"=>$bc_ev
        ],200);




    }
    
    
    
    
     public function addallbcbranch(Request $req)
    {
        $bc_cafe=DB::table('bc_branch')->insert([
            'isactive'=>$req->input('isactive'),
            'bc_type'=>$req->input('bc_type'),
            'name'=>$req->input('name'),
            'address'=>$req->input('address'),
            'add_lat'=>$req->input('add_lat'),
            'add_lon'=>$req->input('add_lon')
            
        
        ]);
            
       

        return response()->json([
            "BC Cafe"=>$bc_cafe,
           
        ],200);




    }
    
    
     public function addallbcbranch(Request $req)
    {
        $bc_cafe=DB::table('bc_branch')->where(
            'id'=>$req->input('id')
           
            
        
        )->delete();
            
       

        return response()->json([
            "BC Cafe"=>$bc_cafe,
           
        ],200);




    }
}
