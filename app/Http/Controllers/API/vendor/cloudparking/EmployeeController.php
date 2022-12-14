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
        
            $employee=new employee;
            $employee->employee_name=$request->input('employee_name');
            $employee->user_id=$request->input('user_id');
            $employee->vendor_id=$request->input('vendor_id');
            $employee->aadhar_document="";
            $employee->is_active=$request->input('is_active');
          

            $employee-> save();

            return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);
    
}
public function editEmployee(Request $request){

      
    $emp= Auth::user();  
        $employee=employee::where('id','=',$request->input('id'))->delete(
           
        );
        $epmstatus=DB::table('users')->where('id',$request->input('employee_id'))->update(["is_admin"=>0]);
       

        return response()->json(['status'=>'Sucess','message'=>'Deatils uploaded sucessfully'],200);
      
          
}
public function getEmployee(Request $request){
    $emp= Auth::user();  
    $data=DB::table('employees')->where('vendor_id',$emp->id)->get();




    
    return response(["data"=>$data],200);
}

public function customerDetails(Request $request){
    $emp= Auth::user();  
    //dd($emp->id);
    $data=DB::table('users')
    ->leftjoin('book_parking','users.id','=','book_parking.user_id')
    ->leftjoin('add_praking_slots','book_parking.parking_slot_number','=','add_praking_slots.id')
    ->leftjoin('vendor','add_praking_slots.user_id','=','vendor.id')
    ->where('users.is_admin','=',3)
    ->where('users.id','=',$emp->id)
    ->select('users.id','users.name','users.email','users.phonenumber','vendor.id as vendor','vendor.ven_name','book_parking.paking_type','book_parking.parking_amt','book_parking.address_id','book_parking.payment_status','book_parking.parking_status','book_parking.payment_id','book_parking.start_date','book_parking.end_date','book_parking.parking_slot_number','book_parking.qrcode')
    ->get();
    return $data;
}
public function vendorDetails(Request $request){
    $emp= Auth::user();  
    //dd($emp->id);
    $data=DB::table('employees')
    ->leftjoin('users','employees.user_id','=','users.id')
    ->leftjoin('vendor','employees.vendor_id','=','vendor.id')
    ->leftjoin('add_praking_slots','vendor.id','=','add_praking_slots.user_id')
    ->where('users.is_admin','=',2)
    ->where('users.id','=',$emp->id)
    ->select('vendor.id','vendor.ven_name','vendor.ven_description','vendor.ven_address_id','vendor.ven_phone','vendor.ven_email','add_praking_slots.parking_type','add_praking_slots.parking_no','add_praking_slots.starts_at','add_praking_slots.ends_at','add_praking_slots.parking_slots','add_praking_slots.address_id')

    ->get();
    return $data;
}


}
