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

        
        Route::get('/detailProduct_edit/{id}','ProductDetailController@edit');
        Route::post('/product_detail_edit/{id}','ProductDetailController@update');
        Route::resource('/detailProduct','ProductDetailController');

        Route::resource('/image','ImageController');

        

        Route::get('/getBranch','BranchController@getData');
        Route::get('/branch_showedit/{id}','BranchController@edit');
        Route::post('/branch_edit/{id}','BranchController@update');
        Route::resource('/branch','BranchController');

        

        Route::group(['middleware' => 'role:super-admin'], function () {
            Route::get('/getUser','UserController@getData');
            Route::post('/user_edit/{id}','UserController@update');
            Route::resource('/user','UserController');

            Route::post('/role_edit/{id}','RoleController@update');
            Route::get('/getRole','RoleController@getData');
            Route::resource('/role','RoleController');

            Route::post('/permission_edit/{id}','PermissionController@update');
            Route::get('/getPermission','PermissionController@getData');
            Route::resource('/permission','PermissionController');

            Route::get('/permission-of-role/{id}', 'RoleController@getPermission');

            Route::get('/changeRolePerms/{id}','RoleController@changeRolePerms');
        });

        Route::group(['middleware' => 'role:super-admin|manager'], function () {
            Route::get('/getEmployee','EmployeeController@getData');
            Route::post('/employee_edit/{id}','EmployeeController@update');
            Route::resource('/employee','EmployeeController');

            Route::get('/getCustomer','CustomerController@getData');
            Route::post('/customer_edit/{id}','CustomerController@update');
            Route::resource('/customer','CustomerController');
        });

        Route::group(['middleware' => 'role:super-admin|editor|sale-manager'], function () {
            Route::get('/getCoupon','CouponController@getData');
            Route::post('/coupon_edit/{id}','CouponController@update');
            Route::resource('/coupon','CouponController');

            Route::get('/getCategory','CategoryController@getData');
            Route::post('/category_edit/{id}','CategoryController@update');
            Route::resource('/category','CategoryController');

            Route::get('/order/{type}','OrderController@index')->name('getOrder');
            Route::get('/getOrder/{type}','OrderController@getData');
            Route::resource('/order','OrderController');
        });
    });
});


//cho nguoi dung (customer)
// Auth::routes();
// Route::get('login', 'AuthCustomer\LoginController@showLoginForm')->name('customer-login');
Route::post('/login', 'AuthCustomer\LoginController@login');
Route::post('/logout', 'AuthCustomer\LoginController@logout')->name('customer-logout');
Route::get('/', function() {
    return view('sale.home');
});
Route::get('register', 'AuthCustomer\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'AuthCustomer\RegisterController@register');
Route::get('/info/{id}', 'ProductController@showInfoProduct');

Route::prefix('cart')->group(function(){
    Route::post('/add/{id}', 'CartController@add');
    Route::get('/show/{id}', 'CartController@show');
    Route::get('/getData', 'CartController@getData');
    Route::get('/total', 'CartController@getTotal');
    Route::post('/delete-product/{id}', 'CartController@deleteProduct');
    Route::post('/minus-product/{id}', 'CartController@minusProduct');
    Route::post('/plus-product/{id}', 'CartController@plusProduct');
});
Route::get('/checkout', 'CartController@checkout');
Route::post('/orderOnline', 'OrderController@orderOnline');
// Route::get('/test',function(){
//     $user = App\Role::find(1);
//     foreach ($user->permissions as $value) {
//         echo($value->pivot->role_id);
//     }
// });