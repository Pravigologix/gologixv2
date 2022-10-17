<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use DB;

class BannerController extends Controller {

    //Display a listing of the resource.

    public function bannerDetails() {
        //$data = Banner::all();
        $data = DB::select( 'SELECT * FROM banners' );
        return response()->json( [ 'Banner_details'=>$data ], 200 );
    }

//<<<<<<< ashwini
   
     // Display the specified resource.
    
    public function bannerdeatail(Request $request)
    {
        $data=Banner::find($request->input('id'));
        return response()->json(["Banner_details_particular_id"=>$data],200);
    }

    //Show the form for editing the specified resource.
   
    public function editBanner(Request $request)
    {

        
       $data=DB::table('banners')->where('banners.id','=',$request->input('id'))->update(['banner_image_url'=>$request->input('banner_image_url'),'banner_descprition'=>$request->input('banner_descprition')]);
      
      //$d=DB::table('banners')->get();
      // return $d;
        return response()->json(['data successfully updated.']);
    }

    
/*=======
    // Display the specified resource.

    public function show( Request $request ) {
        $data = Banner::find( $request->input( 'id' ) );
        return response()->json( [ 'Banner_details_particular_id'=>$data ], 200 );
    }

    //Show the form for editing the specified resource.

    public function edit( Request $request ) {
        $data = DB::table( 'banners' )->where( 'banners.id', '=', $request->input( 'id' ) )->update( [ 'banner_image_url'=>$request->input( 'banner_image_url' ), 'banner_descprition'=>$request->input( 'banner_descprition' ) ] );

        //$d = DB::table( 'banners' )->get();
        // return $d;
        return response()->json( [ 'data successfully updated.' ] );
    }

    //Remove the specified resource from storage.

    public function destroy( Request $request ) {
        $data = Banner::find( $request->input( 'id' ) );
        $data->delete();

        //$d = DB::table( 'banners' )->get();
        // return $d;

        return response()->json( [ 'data successfully deleted.' ] );
    }
//>>>>>>> main
*/
}