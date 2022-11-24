<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\API\User\cloudparking\BannerController;

use Illuminate\Support\Facades\DB;
use App\Models\Banner;
use App\Models\vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


Route::get('routes', function () {
    $routeCollection = Route::getRoutes();

    echo "<table style='width:100%'>";
    echo "<tr>";
    echo "<td width='10%'><h4>index</h4></td>";

    echo "<td width='10%'><h4>HTTP Method</h4></td>";
    echo "<td width='10%'><h4>Route</h4></td>";
    echo "<td width='10%'><h4>Name</h4></td>";
    echo "<td width='70%'><h4>Corresponding Action</h4></td>";
    echo "</tr>";
    foreach ($routeCollection as $key=>$value) {
        echo "<tr>";
        echo "<td>" . $key+1 . "</td>";
        echo "<td>" . $value->methods()[0] . "</td>";
        echo "<td>" . $value->uri() . "</td>";
        echo "<td>" . $value->getName() . "</td>";
        echo "<td>" . $value->getActionName() . "</td>";
        echo "</tr>";
    }
    echo "</table>";
});





Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AdminController::class, 'login'])->name('admin-login');
Route::get('/verify-vendor/{id}', [AdminController::class, 'verifyvendor'])->name('verify-vendor');
Route::get('/verify-user/{id}', [AdminController::class, 'makeuseriactive'])->name('verify-user');
Route::get('/verify-user-active/{id}', [AdminController::class, 'makeuseractive'])->name('verify-user-active');



Route::post('/admin-login-post', [AdminController::class, 'adminlogin'])->name('adminlogin');
Route::get('/admin-login-posts',function(){
    return view('admin.vendor.vendor');

});
Route::get('/help/all',function(){
    return view('helpandsupport');

});
Route::group(['middleware' => 'prevent-back-history'],function(){
Route::get('/logout',function(){
    Session::flush();
        
    Redirect::back();
    
    return redirect('/admin/login');

});
});



Route::get('/getvendordetailstoadminbyid/{id}', [AdminController::class, 'getvendordetailstoadminbyid'])->name('getvendordetailstoadminbyid');



Route::post('/help/all/post',[AdminController::class, 'support'])->name('postsupport');
Route::post('/canceled/return/{id}/{booking_id}/{price}',[AdminController::class, 'returnamout'])->name('returnamt');
Route::post('/canceled/clear/{booking_id}',[AdminController::class, 'clearamout'])->name('clearamt');


Route::post('/add/banner',[BannerController::class, 'addBannerbyadmin'])->name('addbanner');

Route::get('/delete/banner/{id}',[BannerController::class, 'destroy'])->name('deletebanner');

Route::post('/add/video',[BannerController::class, 'addvideobyadmin'])->name('addvideo');

// Route::post('/delete/banner',[BannerController::class, 'destroy'])->name('deletebanner');
Route::post('/delete/video/{id}',[BannerController::class, 'destroyclip'])->name('deletevideo');


Route::post('/add/bcbranch',[AdminController::class, 'addbcbranch'])->name('addbcbranch');
Route::post('/vendor/{id}',[AdminController::class, 'getvendordetailstoadminbyid'])->name('vendorbyid');


Route::post('/delete/bcbranch/{id}',[AdminController::class,'deletebcbranch'])->name('deletebcbranch');





// Route::get('/banner',function(){
//     return view('admin.layouts.banners.banner');

// });

// Route::middleware([])->group(function () {
   
    Route::get('/home-test', [AdminController::class, 'home123']);
    Route::get('/vendor',[AdminController::class,'getvendor'])->name('Vendor');
// });
    Route::get('/transaction',[AdminController::class,'transcation']);
    // Route::get('/vendor',[AdminController::class,'getvendor'])->name('Vendor');
    Route::get('/users',[AdminController::class,'getuser']);
    
    Route::get('/help&suppot',[AdminController::class,'helpandsupport']);
    
    Route::get('/cancel/orders',[AdminController::class,'cancelorders']);
    Route::get('/banner',[AdminController::class,'banners']);
    
    
        Route::get('/bcbranch',[AdminController::class,'bcbranch']);
      




