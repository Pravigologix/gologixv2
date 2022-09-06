<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use POST;
use DB;

class filterController extends Controller
{
    Public function filter(Request $request){
        $distances=DB::table('')->select('distances')->distinct()->get()->pluck('distances');

        $post=POST::query();
        if($request->filled('distances')){
            $post->where('distances',$request->distance);
            return $distances;
        }
        
    }
}
