<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DB;

class SearchCustomerController extends Controller {
    public function searchCustomer( Request $request ) {
        $user = Auth::user();
        $data = DB::table( 'book_parking' )
        ->leftjoin( 'addresses', 'book_parking.address_id', '=', 'addresses.id' )
        ->select( DB::raw( 'count(*) as count, HOUR(book_parking.created_at) as hour' ) )
        ->whereDate( 'book_parking.created_at', '=', Carbon::now()->toDateString() )
        ->groupBy( 'hour' )
        ->get();

        return response()->json( [ 'User_parking_details'=>$data ], 200 );
    }

}
