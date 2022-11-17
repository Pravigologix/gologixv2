<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;
use App\Models\vendor;
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



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', [AdminController::class, 'login'])->name('admin-login');
Route::post('/admin-login-post', [AdminController::class, 'adminlogin'])->name('adminlogin');
Route::get('/admin-login-posts',function(){
    return view('admin.vendor.vendor');

});
Route::get('/help/all',function(){
    return view('helpandsupport');

});
Route::post('/help/all/post',[AdminController::class, 'support'])->name('postsupport');
Route::post('/canceled/return/{id}/{booking_id}/{price}',[AdminController::class, 'returnamout'])->name('returnamt');
Route::post('/canceled/clear/{booking_id}',[AdminController::class, 'clearamout'])->name('clearamt');


Route::post('/add/banner',[BannerController::class, 'addBannerbyadmin'])->name('addbanner');
Route::post('/delete/banner',[BannerController::class, 'destroy'])->name('deletebanner');

Route::post('/add/bcbranch',[AdminController::class, 'addbcbranch'])->name('addbcbranch');

Route::post('/delete/bcbranch/{id}',[AdminController::class,'deletebcbranch'])->name('deletebanner');




Route::get('/banner',function(){
    return view('admin.layouts.banners.banner');

});
Route::get('/transaction',function(){
    $trans=DB::table('payments')->join('users','payments.pay_user_id','=','users.id')
    ->orderBy('id','desc')->select("payments.*",'users.name')
    ->paginate(80);
    $total_price=DB::table('payments')->where('pay_paysta_status_id',7)->sum('pay_price');
    
    return view('admin.layouts.payment.payment',["trans"=>$trans,"total_price"=>$total_price]);

});
Route::get('/vendor',function(){ 
    $vendor=DB::table('users')->where('is_admin',2)->paginate(20);
    //return $vendor;
    return view('admin.layouts.vendor.vendor',["vendor"=>$vendor]);

});Route::get('/users',function(){

    $users=DB::table('users')->where('is_admin',0)->paginate(10);
    return view('admin.layouts.users.users',["users"=>$users]);

});

Route::get('/help&suppot',function(){

    $support=DB::table('helpandsupport')->orderBy("id", "desc")->paginate(20);





    return view('admin.layouts.help.help',["support"=>$support]);

});

Route::get('/cancel/orders',function(){

    $orders=DB::table('book_parking')->orderBy("id", "desc")->where('parking_status',5)->where('is_cacnceled',0)->join('payments','book_parking.payment_id','=','payments.id')->select('book_parking.*','payments.pay_price')
    ->paginate(30);





    return view('admin.layouts.cancel.cancel',["orders"=>$orders]);

});
Route::get('/banner',function(){

    $users=DB::table('banners')->get();

      return view('admin.layouts.banners.banner',["banners"=>$users]);
    });

    Route::get('/bcbranch',function(){

        $users=DB::table('bc_branch')->get();
    
          return view('admin.layouts.bcbranch.bcbranch',["banners"=>$users]);
        });
  

