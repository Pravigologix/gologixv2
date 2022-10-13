<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TimingController extends Controller
{
    public function startDateTime(Request $req){

    $start_tym=book_parking::get('id');
       return $start_tym;
    }

}