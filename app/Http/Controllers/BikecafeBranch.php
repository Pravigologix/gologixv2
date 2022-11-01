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
}
