<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function image(Request $request){
        $result=$request->file('file')->store('apiFile','public');
        return ["result"=>$result];
    }
}
