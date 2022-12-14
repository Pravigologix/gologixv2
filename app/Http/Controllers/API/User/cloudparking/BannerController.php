<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use DB;

class BannerController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Display a listing of the resource.

    public function bannerDetails() {
        //$data = Banner::all();
        $data = DB::select( 'SELECT * FROM banners' );
        return response()->json( ['Banner_details'=>$data ], 200 );
    }
    
      public function getbanners() {

        $data = DB::table('banners')->get(); 
           $data_video = DB::table('videoclip')->get(); 
        return response()->json( [ 'Banner_details'=>$data,'Banner_video_details'=>$data_video,], 200 );
    }

    
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

    //Remove the specified resource from storage.

   
}
