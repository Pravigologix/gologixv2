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
use App\Http\Controllers\API\Profile\ProfileController;



use App\Http\Controllers\API\User\cloudparking\userStatus;
use App\Http\Controllers\API\vendor\cloudparking\VendorDetailsController;
use App\Http\Controllers\API\vendor\cloudparking\VendorAccountsController;
use App\Http\Controllers\API\vendor\cloudparking\VendorkycController;
use App\Http\Controllers\API\User\cloudparking\User_documentController;
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

// Route::get('index',[ParkingController::class,'index']);  
//Route::get('filter',[filterController::class,'filter']);     
//Route::get('qrCode',[qrcodeController::class,'qrCode']); 
//Route::get('status',[userStatus::class,'status']);   
//=======
//Route::get('/index',[ParkingController::class,'index']);


//Route::get('/index',[ParkingController::class,'index']);



 });
// Route::get('/push-notificaiton', [notificationController::class,'index']);
// Route::post('/store-token', [notificationController::class,'storeToken']);
// Route::post('/send-web-notification', [notificationController::class,'sendWebNotification']);




Route::group(['middleware'=>['auth']],function(){
    Route::get('customer', [VendorCustomerController::class,'customer']);
    Route::get('vendorcustomer', [VendorCustomerController::class,'vendor']);
    Route::get('users', [UserDetailsControoller::class,'users']);
   


Route::get('index',[ParkingController::class,'index']);  
Route::get('filter',[filterController::class,'filter']);     
Route::get('getqrCode',[qrcodeController::class,'getqrCode']); 
Route::post('addqrCode',[qrcodeController::class,'addqrCode']); 

Route::get('status',[userStatus::class,'status']);   


Route::post('/walletamount', [WalletController::class,'addwalletamount']);
Route::get('/getwalletamount', [WalletController::class,'getwalletamount']);
Route::post('/debitwalletamount', [WalletController::class,'debitwalletamount']);




Route::get('bannerDetails', [BannerController::class,'bannerDetails']);
Route::get('show', [BannerController::class,'show']);
Route::get('edit', [BannerController::class,'edit']);
Route::get('destroy', [BannerController::class,'destroy']);
// Route::get('walletDetails', [WalletController::class,'walletDetails']);
// Route::post('updateWallet', [WalletController::class,'updateWallet']);
// Route::get('updatingeWallet', [WalletController::class,'updatingeWallet']);


//Route::group(['middleware'=>['auth']],function(){
    Route::get('getparkingaddress',[AddParkingController::class,'getparkingdeatils']);
    Route::post('getparkingcharges',[AddParkingController::class,'getparkingcharges']);

    Route::post('addpakingaddress',[AddParkingController::class,'addparkingdetails']);
    Route::post('editpakingaddress',[AddParkingController::class,'editparkingdetails']);
    Route::post('addparkingslotdetails',[AddParkingController::class,'addparkingslotdetails']);

    Route::get('getparkingslotdetails',[AddParkingController::class,'getparkingslotdetails']);
    Route::post('updateparkingslotdetails',[AddParkingController::class,'updateparkingslotdetails']);
    Route::get('getparkingdescdetails',[AddParkingController::class,'getparkingdescdetails']);
    Route::get('getuserdetails',[ProfileController::class,'getprofile']);
    Route::post('addprofilepicture',[ProfileController::class,'addprofilepicture']);




    Route::post('getdetails',[UserParkingdeatils::class,'generateparkinglslotforuser']);
    Route::post('bookparking',[BookParking::class,'bookpakingbyuser']);
 

    Route::post('addVendorDetails',[VendorDetailsController::class,'addVendorDetails']);
Route::get('getVendorDetails',[VendorDetailsController::class,'getVendorDetails']);
Route::post('addVendorAccountDetails',[VendorAccountsController::class,'addVendorAccountDetails']);
Route::get('getVendorAccountDetails',[VendorAccountsController::class,'getVendorAccountDetails']);
Route::post('addVendorkyc',[VendorkycController::class,'addVendorkyc']);
Route::get('getVendorkyc',[VendorkycController::class,'getVendorkyc']);
Route::post('addUserVehicleDocuments',[User_documentController::class,'addUserVehicleDocuments']);
Route::get('getUserVehicleDocuments',[User_documentController::class,'getUserVehicleDocuments']);


});
