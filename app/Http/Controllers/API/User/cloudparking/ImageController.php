<?php

namespace App\Http\Controllers\API\User\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ImageController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

    
        $filejustname =pathinfo('image', PATHINFO_FILENAME);
        // Get just extension of user upload file
        $extention ='image'->getClientOriginalExtension();
      $fileName = $filejustname .time() ."." .$extention ;
    
      $destinationPath =public_path().'/images'.'/ProductsImages';
      $img = Image::make($file->getRealPath());
      
      $img->resize(10, 10, function ($constraint) {
          $constraint->aspectRatio();
          
        })->save($destinationPath.'/'.$fileName);
    
          $destinationPath = public_path().'/images'.'/ProductsImages' ;
          
          $fileupload=$file->move($destinationPath,$fileName);
          $imagedata=$destinationPath.'/'.$fileName;  
          
       dd($imagedata);
    }

}