<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/images',function(){
//     return view('manager.test');
// });
// Route::post('/upload-image','ProductController@uploadImage');

Route::post('/deleteImg','ProductController@deleteImage');

//cho nguoi dung (customer)
// Auth::routes();
Route::get('login', 'AuthCustomer\LoginController@showLoginForm')->name('customer-login');
Route::post('login', 'AuthCustomer\LoginController@login');
Route::post('logout', 'AuthCustomer\LoginController@logout')->name('customer-logout');


//cho admin
Route::prefix('admin')->group(function(){

    //login (khong can qua checkAuth)
    Auth::routes();

    //cac function can qua check login
    Route::middleware('auth')->group(function() {

        Route::get('/getProduct','ProductController@getData');
        Route::post('/product_edit/{id}','ProductController@update');
        Route::get('/product_showedit/{id}','ProductController@edit');
        Route::resource('/product','ProductController');

        Route::post('/upload-image','ImageController@create');


        Route::get('/order/{type}','OrderController@index')->name('getOrder');
        Route::get('/getOrder/{type}','OrderController@getData');
        Route::resource('/order','OrderController');

        Route::get('/getBranch','BranchController@getData');
        Route::get('/branch_showedit/{id}','BranchController@edit');
        Route::post('/branch_edit/{id}','BranchController@update');
        Route::resource('/branch','BranchController');

        Route::get('/getEmployee','EmployeeController@getData');
        Route::post('/employee_edit/{id}','EmployeeController@update');
        Route::resource('/employee','EmployeeController');

        Route::get('/getCoupon','CouponController@getData');
        Route::post('/coupon_edit/{id}','CouponController@update');
        Route::resource('/coupon','CouponController');

        Route::get('/getUser','UserController@getData');
        Route::resource('/user','UserController');

        Route::get('/getCategory','CategoryController@getData');
        Route::post('/category_edit/{id}','CategoryController@update');
        Route::resource('/category','CategoryController');

        Route::get('/getCustomer','CustomerController@getData');
        Route::resource('/customer','CustomerController');

        Route::get('/getOption','OptionController@getData');
        Route::resource('/option','OptionController');

        Route::get('/getOptionValue','OptionValueController@getData');
        Route::resource('/option-value','OptionValueController');
    });
});