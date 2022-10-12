<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;

use App\Http\Controllers\API\User\cloudparking\ParkingController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\User\cloudparking\filterController;
use App\Http\Controllers\API\User\cloudparking\qrcodeController;
use App\Http\Controllers\API\User\cloudparking\notificationController;
use App\Http\Controllers\API\User\cloudparking\VendorCustomerController;
use App\Http\Controllers\API\User\cloudparking\UserDetailsControoller;
use App\Http\Controllers\API\User\cloudparking\ImageController;
use App\Http\Controllers\API\User\cloudparking\BannerController;
use App\Http\Controllers\API\User\cloudparking\WalletController;
use App\Http\Controllers\API\User\cloudparking\SearchCustomerController;

use App\Http\Controllers\API\vendor\cloudparking\AddParkingController;
use App\Http\Controllers\API\vendor\cloudparking\UserParkingdeatils;
use App\Http\Controllers\API\User\cloudparking\BookParking;
use App\Http\Controllers\API\profile\ProfileController;

use App\Http\Controllers\API\User\cloudparking\GetAllAddressController;
use App\Http\Controllers\API\User\cloudparking\UserBookingDetails;
use App\Http\Controllers\API\User\cloudparking\UserTransactionDetails;
use App\Http\Controllers\API\vendor\cloudparking\UserBookingDeatils;





use App\Http\Controllers\API\User\cloudparking\userStatus;
use App\Http\Controllers\API\vendor\cloudparking\VendorDetailsController;
use App\Http\Controllers\API\vendor\cloudparking\VendorAccountsController;
use App\Http\Controllers\API\vendor\cloudparking\VendorkycController;
use App\Http\Controllers\API\User\cloudparking\User_documentController;
use App\Http\Controllers\API\User\cloudparking\VehicleController;
use App\Http\Controllers\API\vendor\cloudparking\SecurityController;
use App\Http\Controllers\API\vendor\cloudparking\EmployeeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::controller(AuthController::class)
->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'request_otp');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('register/verify_otp', 'register');
    Route::get('auth/google', 'AuthController@redirectToGoogle');
    Route::get('get_session', 'get_session');
    Route::get('auth/google/callback', 'AuthController@handleGoogleCallback');
    Route::get('auth/google/callback', 'AuthController@handleGoogleCallback');
    });
    Route::group(['middleware'=>['auth']],function(){
    Route::get('customervendor', [VendorCustomerController::class,'customer']);
    Route::get('vendorcustomer', [VendorCustomerController::class,'vendor']);
    Route::get('users', [UserDetailsControoller::class,'users']);

    Route::get('getuserdetailstovendor', [UserBookingDeatils::class,'getuserdetails']);

         
    Route::get('getqrCode',[qrcodeController::class,'getqrCode']); 
    Route::post('addqrCode',[qrcodeController::class,'addqrCode']); 
    Route::post('/walletamount', [WalletController::class,'addwalletamount']);
    Route::get('/getwalletamount', [WalletController::class,'getwalletamount']);
    Route::post('/debitwalletamount', [WalletController::class,'debitwalletamount']);
         Route::post('/updatewalletamount', [WalletController::class,'updatewalletamount']);
        
        
        
    Route::get('getparkingaddress',[AddParkingController::class,'getparkingdeatils']);
    Route::post('getparkingcharges',[AddParkingController::class,'getparkingcharges']);
    Route::post('addpakingaddress',[AddParkingController::class,'addparkingdetails']);
    Route::post('editpakingaddress',[AddParkingController::class,'editparkingdetails']);
    Route::post('addparkingslotdetails',[AddParkingController::class,'addparkingslotdetails']);
    Route::get('getparkingslotdetails',[AddParkingController::class,'getparkingslotdetails']);
    Route::post('updateparkingslotdetails',[AddParkingController::class,'updateparkingslotdetails']);
    Route::get('getparkingdescdetails',[AddParkingController::class,'getparkingdescdetails']);
    Route::get('getuserdetails',[ProfileController::class,'getprofile']);
    Route::post('addprofile',[ProfileController::class,'addprofile']);
    Route::post('getdetails',[UserParkingdeatils::class,'generateparkinglslotforuser']);
    Route::post('bookparking',[BookParking::class,'bookpakingbyuser']);
         Route::post('updatebookpakingbyuser',[BookParking::class,'updatebookpakingbyuser']);
        
    Route::post('addVendorDetails',[VendorDetailsController::class,'addVendorDetails']);
    Route::post('editVendorDetails',[VendorDetailsController::class,'editVendorDetails']);

Route::get('getVendorDetails',[VendorDetailsController::class,'getVendorDetails']);
Route::post('addVendorAccountDetails',[VendorAccountsController::class,'addVendorAccountDetails']);
Route::post('editVendorAccountDetails',[VendorAccountsController::class,'editVendorAccountDetails']);
Route::get('getVendorAccountDetails',[VendorAccountsController::class,'getVendorAccountDetails']);
Route::post('addVendorkyc',[VendorkycController::class,'addVendorkyc']);
Route::get('getVendorkyc',[VendorkycController::class,'getVendorkyc']);
Route::post('addUserVehicleDocuments',[User_documentController::class,'addUserVehicleDocuments']);
Route::post('editUserVehicleDocuments',[User_documentController::class,'editUserVehicleDocuments']);

Route::get('getUserVehicleDocuments',[User_documentController::class,'getUserVehicleDocuments']);
Route::post('addVehicle',[VehicleController::class,'addVehicle']);
Route::post('editVehicle',[VehicleController::class,'editVehicle']);
Route::get('getVehicle',[VehicleController::class,'getVehicle']);

Route::post('addEmployee',[EmployeeController::class,'addEmployee']);
Route::post('editEmployee',[EmployeeController::class,'editEmployee']);
Route::get('getEmployee',[EmployeeController::class,'getEmployee']);

});
Route::post('securityRegister',[SecurityController::class,'securityRegister']);
Route::get('customerDetails',[EmployeeController::class,'customerDetails']);
Route::get('vendorDetails',[EmployeeController::class,'vendorDetails']);

Route::get('getallparkingAddress',[ParkingController::class,'getalladdress']);  
Route::get('getAllAddress',[GetAllAddressController::class,'getAllAddress']);  
Route::post('addAddress',[GetAllAddressController::class,'addAddress']);  
Route::get('bookingDetails',[UserBookingDetails::class,'bookingDetails']);  
Route::get('getTransactionDetails',[UserTransactionDetails::class,'getTransactionDetails']);  
