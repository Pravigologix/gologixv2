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
Route::get('auth/google/callback', 'AuthController@handleGoogleCallback');
// Route::get('index',[ParkingController::class,'index']);  
Route::get('filter',[filterController::class,'filter']);     
Route::get('qrCode',[qrcodeController::class,'qrCode']); 
Route::get('status',[userStatus::class,'status']);   

});
Route::get('/push-notificaiton', [notificationController::class,'index']);
Route::post('/store-token', [notificationController::class,'storeToken']);
Route::post('/send-web-notification', [notificationController::class,'sendWebNotification']);


Route::group(['middleware'=>['auth']],function(){
    Route::get('/customer', [VendorCustomerController::class,'customer']);
    Route::get('/vendor', [VendorCustomerController::class,'vendor']);
    Route::get('/users', [UserDetailsControoller::class,'users']);
    Route::get('/image', [ImageController::class,'image']);
}
);

Route::get('/bannerDetails', [BannerController::class,'bannerDetails']);
Route::get('/show', [BannerController::class,'show']);
Route::get('/edit', [BannerController::class,'edit']);
Route::get('/destroy', [BannerController::class,'destroy']);