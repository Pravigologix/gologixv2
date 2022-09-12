<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;

use App\Http\Controllers\API\vendor\cloudparking\AddParkingController;
use App\Http\Controllers\API\vendor\cloudparking\UserParkingdeatils;
use App\Http\Controllers\API\User\cloudparking\BookParking;
use App\Http\Controllers\API\User\cloudparking\qrcodeController;







use App\Http\Controllers\API\User\cloudparking\ParkingController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\User\cloudparking\filterController;
use App\Http\Controllers\API\User\cloudparking\qrcodeController;
use App\Http\Controllers\API\User\cloudparking\userStatus;
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

//Route::get('/index',[ParkingController::class,'index']);



});


Route::get('index',[ParkingController::class,'index']);  
Route::get('filter',[filterController::class,'filter']);     
Route::get('qrCode',[qrcodeController::class,'qrCode']); 
Route::get('status',[userStatus::class,'status']);   


// });

Route::group(['middleware'=>['auth']],function(){
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



// Route::get('/index', 'App\Http\Controllers\API\User\cloudparking\ParkingController@index');

Route::get('qrCode',[qrcodeController::class,'qrCode']);