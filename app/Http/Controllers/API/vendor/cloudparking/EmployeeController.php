<?php

namespace App\Http\Controllers\API\vendor\cloudparking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\employee;
use Auth;
use DB;

class EmployeeController extends Controller
{
    public function addEmployee(Request $request){
        $files=$request['aadhar_document'];
        $hostname=$_SERVER['HTTP_HOST'];
                $filejustname =pathinfo($files, PATHINFO_FILENAME);
                // Get just extension of user upload file
                $extention =$files->getClientOriginalExtension();
                $fileName = $filejustname .time() ."." .$extention ;
                $destinationPath = public_path().'/images'.'/aadhar_card';
                $fileupload=$files->move($destinationPath,$fileName);
          $aadhar_image=env('APP_URL').'/images'.'/aadhar_card'.'/'.$fileName;    
          
        $emp= Auth::user();  
       
            $employee=new employee;
            $employee->employee_name=$request->input('employee_name');
            $employee->user_id=(int)$emp->id;
            $employee->vendor_id=$request->input('vendor_id');
            $employee->aadhar_document=json_encode($aadhar_image);
            $employee->is_active=$request->input('is_active');
            $employee->is_delete=$request->input('is_delete');

            $employee-> save();

            return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);
    
}
}
