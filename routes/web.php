<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Guest Routes //,
Route::group(['namespace' => 'Guest', 'middleware'=>['guest']], function (){
    Route::get('/', 'WelcomeController@index')->name('welcome');
    Route::post('/guest/get/upazila-of-a-district', 'AjaxController@getUpazilaOfDistrict');
    Route::post('/guest/submit/customer-register', 'AjaxController@submitCustomerRegister');
    Route::get('/worker-register', 'RegisterController@getWorkerRegisterForm')->name('welcome');
});

Route::get('/admin', function (){
    return redirect()->route('admin.dashboard.index');
});
//Admin Routes
Route::group(['namespace' => 'Admin', 'as' => 'admin.', 'prefix'=>'admin', 'middleware'=>['admin', 'auth']], function (){
    Route::resource('dashboard', 'DashboardController')->except(['create','store', 'show', 'edit', 'update', 'destroy']);

    Route::resource('district', 'DistrictController')->except(['create','show', 'edit', 'destroy']);
    Route::resource('upazila', 'UpazilaController')->except(['create','show', 'edit', 'destroy']);

    Route::resource('worker-service-category', 'WorkerServiceCategoryController')->except(['create','show', 'edit', 'update', 'destroy']);
    Route::post('worker-service-category/update','WorkerServiceCategoryController@update');
    Route::resource('worker-service', 'WorkerServiceController')->except(['create','show', 'edit', 'update', 'destroy']);
    Route::post('worker-service/update','WorkerServiceController@update');

    Route::resource('membership-service-category', 'MembershipServiceCategoryController')->except(['create','show', 'edit', 'update', 'destroy']);
    Route::post('membership-service-category/update','MembershipServiceCategoryController@update');
    Route::resource('membership-service', 'MembershipServiceController')->except(['create','show', 'edit', 'update', 'destroy']);
    Route::post('membership-service/update','MembershipServiceController@update');

    Route::resource('admin-notice', 'AdminNoticeController')->except(['create','show', 'edit', 'update', 'destroy']);
    Route::post('admin-notice/update','AdminNoticeController@update');
    Route::resource('controller-notice', 'ControllerNoticeController')->except(['store', 'create','show', 'edit', 'update', 'destroy']);
    Route::post('controller-notice/update','ControllerNoticeController@update');

    Route::resource('admin-ads', 'AdminAdsController')->except(['create','show', 'edit', 'update', 'destroy']);
    Route::post('admin-ads/update','AdminAdsController@update');
    Route::resource('controller-ads', 'ControllerAdsController')->except(['store', 'create','show', 'edit', 'update', 'destroy']);
    Route::post('controller-ads/update','ControllerAdsController@update');


});

Route::get('/controller', function (){
    return redirect()->route('controller.dashboard.index');
});
//Controller Routes
Route::group(['namespace' => 'Controller', 'as' => 'controller.', 'prefix'=>'controller', 'middleware'=>'controller'], function (){
    Route::resource('dashboard', 'DashboardController')->except(['create','store', 'show', 'edit', 'update', 'destroy']);
});

Route::get('/worker', function (){
    return redirect()->route('worker.home.index');
});
//Worker Routes
Route::group(['namespace' => 'Worker', 'as' => 'worker.', 'prefix'=>'worker', 'middleware'=>'worker'], function (){
    Route::resource('home', 'HomeController')->except(['create','store', 'show', 'edit', 'update', 'destroy']);
});

Route::get('/membership', function (){
    return redirect()->route('membership.home.index');
});
//Membership Routes
Route::group(['namespace' => 'Membership', 'as' => 'membership.', 'prefix'=>'membership', 'middleware'=>['membership', 'auth']], function (){
    Route::resource('home', 'HomeController')->except(['create','store', 'show', 'edit', 'update', 'destroy']);
});

Route::get('/customer', function (){
    return redirect()->route('customer.home.index');
});
//Customer Routes
Route::group(['namespace' => 'Customer', 'as' => 'customer.', 'prefix'=>'customer', 'middleware'=>'customer'], function (){
    Route::resource('home', 'HomeController')->except(['create','store', 'edit', 'update', 'destroy']);
    Route::get('/gigs/{id}','HomeController@showGigs')->name('showGigs');
    Route::resource('job', 'JobController')->except(['create', 'update', 'destroy']);
});
