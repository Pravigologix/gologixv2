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

    public function destroy( Request $request,$id ) {
    
        $data = Banner::find($id )->delete();
      
        //$d = DB::table( 'banners' )->get();
        // return $d;

        return redirect('/banner');
    }
    public function destroyclip( $id ) {
        $data = DB::table('videoclip')->where('id',$id)->delete();

        //$d = DB::table( 'banners' )->get();
        // return $d;

        return redirect('admin.layouts.banners.banner');
    }

    public function addBannerbyadmin(Request $request){
        $files=$request->file('banner_image_url');
        $hostname=$_SERVER['HTTP_HOST'];
        
                $filejustname =pathinfo($files, PATHINFO_FILENAME);
                // Get just extension of user upload file
                $extention =$files->getClientOriginalExtension();
                $fileName = $filejustname .time()."." .$extention ;
                $destinationPath = public_path().'/images'.'/banners';
                $fileupload=$files->move($destinationPath,$fileName);
                $banner_url=env('APP_URL').'/images'.'/banners'.'/'.$fileName; 

        $users=DB::table('banners')->insert([
            "banner_image_url"=>$banner_url,
   "banner_descprition"=>$request->input('banner_descprition')


        ]);
       
       


        return redirect('/banner');


    }

    public function addvideobyadmin(Request $request){
        $files=$request->file('clip_url');
        $hostname=$_SERVER['HTTP_HOST'];
        
                $filejustname =pathinfo($files, PATHINFO_FILENAME);
                // Get just extension of user upload file
                $extention =$files->getClientOriginalExtension();
                $fileName = $filejustname .time()."." .$extention ;
                $destinationPath = public_path().'/images'.'/banners';
                $fileupload=$files->move($destinationPath,$fileName);
                $banner_url=env('APP_URL').'/images'.'/banners'.'/'.$fileName; 

        $users=DB::table('videoclip')->insert([
            "clip_url"=>$banner_url,
 


        ]);
       
       


        return redirect('admin.layouts.banners.banner');


    }

}
