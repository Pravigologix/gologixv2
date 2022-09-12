<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;
//<<<<<<< tejashwinirm
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
//=======
//<<<<<<< development
use App\Http\Controllers\API\vendor\cloudparking\AddParkingController;
use App\Http\Controllers\API\vendor\cloudparking\UserParkingdeatils;
use App\Http\Controllers\API\User\cloudparking\BookParking;
use App\Http\Controllers\API\User\cloudparking\qrcodeController;



//>>>>>>> backup





Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'request_otp');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

    Route::post('register/verify_otp', 'register');
    Route::get('auth/google', 'AuthController@redirectToGoogle');
//<<<<<<< development
    Route::get('auth/google/callback', 'AuthController@handleGoogleCallback');
//=======
Route::get('auth/google/callback', 'AuthController@handleGoogleCallback');
//<<<<<<< tejashwinirm
// Route::get('index',[ParkingController::class,'index']);  
//Route::get('filter',[filterController::class,'filter']);     
//Route::get('qrCode',[qrcodeController::class,'qrCode']); 
//Route::get('status',[userStatus::class,'status']);   
//=======
//Route::get('/index',[ParkingController::class,'index']);
//>>>>>>> addparkingspace
//>>>>>>> backup

});
Route::get('/push-notificaiton', [notificationController::class,'index']);
Route::post('/store-token', [notificationController::class,'storeToken']);
Route::post('/send-web-notification', [notificationController::class,'sendWebNotification']);

});

//<<<<<<< tejashwinirm
Route::group(['middleware'=>['auth']],function(){
    Route::get('/customer', [VendorCustomerController::class,'customer']);
    Route::get('/vendor', [VendorCustomerController::class,'vendor']);
    Route::get('/users', [UserDetailsControoller::class,'users']);
    Route::get('/image', [ImageController::class,'image']);


Route::get('/bannerDetails', [BannerController::class,'bannerDetails']);
Route::get('/show', [BannerController::class,'show']);
Route::get('/edit', [BannerController::class,'edit']);
Route::get('/destroy', [BannerController::class,'destroy']);
Route::get('/walletDetails', [WalletController::class,'walletDetails']);
Route::post('/updateWallet', [WalletController::class,'updateWallet']);
Route::get('/updatingeWallet', [WalletController::class,'updatingeWallet']);


//Route::group(['middleware'=>['auth']],function(){
    Route::get('getparkingaddress',[AddParkingController::class,'getparkingdeatils']);
    Route::post('addpakingaddress',[AddParkingController::class,'addparkingdetails']);
    Route::post('editpakingaddress',[AddParkingController::class,'editparkingdetails']);
    Route::post('addparkingslotdetails',[AddParkingController::class,'addparkingslotdetails']);

    Route::get('getparkingslotdetails',[AddParkingController::class,'getparkingslotdetails']);
    Route::post('updateparkingslotdetails',[AddParkingController::class,'updateparkingslotdetails']);
    Route::get('getparkingdescdetails',[AddParkingController::class,'getparkingdescdetails']);


    Route::post('getdetails',[UserParkingdeatils::class,'generateparkinglslotforuser']);
    Route::post('bookparking',[BookParking::class,'bookpakingbyuser']);
 


});


//=======
// Route::get('/index', 'App\Http\Controllers\API\User\cloudparking\ParkingController@index');
//>>>>>>> addparkingspace
//Route::get('qrCode',[qrcodeController::class,'qrCode']);
//>>>>>>> backup
