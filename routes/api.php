<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;
//<<<<<<< development
use App\Http\Controllers\API\vendor\cloudparking\AddParkingController;

//=======
//use App\Http\Controllers\API\User\cloudparking;
// use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
//>>>>>>> addparkingspace

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
//>>>>>>> addparkingspace


});

//<<<<<<< development
    

});

Route::group(['middleware'=>['auth']],function(){
    Route::get('getparkingaddress',[AddParkingController::class,'getparkingdeatils']);
    Route::post('addpakingaddress',[AddParkingController::class,'addparkingdetails']);
    Route::post('editpakingaddress',[AddParkingController::class,'editparkingdetails']);



});
//=======
Route::get('/index', 'App\Http\Controllers\API\User\cloudparking\ParkingController@index');
//>>>>>>> addparkingspace
