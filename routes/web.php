<?php

use Illuminate\Support\Facades\Route;
use smasif\ShurjopayLaravelPackage\ShurjopayService;

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
    Route::post('/guest/get/upazila-of-a-district', 'AjaxController@getUpazilaOfDistrict')->name('getUpazilaOfDistrict');
    Route::post('/guest/submit/customer-register', 'RegisterController@submitCustomerRegister')->name('submitCustomerRegister');

    Route::get('/worker-register', 'RegisterController@getWorkerRegisterForm')->name('getWorkerRegisterForm');
    Route::post('/guest/get/services-of-a-category', 'AjaxController@getServicesOfCategory')->name('getWorkerServicesOfCategory');
    Route::post('/guest/submit/worker-register', 'RegisterController@submitWorkerRegister')->name('submitWorkerRegister');

    Route::get('/membership-register', 'RegisterController@getMembershipRegisterForm')->name('getMembershipRegisterForm');
    Route::post('/guest/get/membership-services-of-a-category', 'AjaxController@getMembershipServicesOfCategory')->name('getMembershipServicesOfCategory');
    Route::post('/guest/submit/membership-register', 'RegisterController@submitMembershipRegister')->name('submitMembershipRegister');

    Route::post('/reset-password', 'PasswordController@resetPassword')->name('resetPassword');
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
    Route::post('admin-notice/update','AdminNoticeController@update')->name('updateAdminNotice');
    Route::resource('controller-notice', 'ControllerNoticeController')->except(['store', 'create','show', 'edit', 'update', 'destroy']);
    Route::post('controller-notice/update','ControllerNoticeController@update')->name('updateControllerNotice');

    Route::resource('admin-ads', 'AdminAdsController')->except(['create','show', 'edit', 'update', 'destroy']);
    Route::post('admin-ads/update','AdminAdsController@update');
    Route::resource('controller-ads', 'ControllerAdsController')->except(['store', 'create','show', 'edit', 'update', 'destroy']);
    Route::post('controller-ads/update','ControllerAdsController@update');

    //Setting
    Route::get('/setting/offer','SettingController@showOffer')->name('showOffer');
    Route::post('/setting/offer','SettingController@updateOffer')->name('updateOffer');

    Route::get('/setting/referral-income','SettingController@showReferralIncome')->name('showReferralIncome');
    Route::post('/setting/referral-income','SettingController@updateReferralIncome')->name('updateReferralIncome');

    Route::get('/setting/video-training','SettingController@showVideoTraining')->name('showVideoTraining');
    Route::post('/setting/video-training','SettingController@updateVideoTraining')->name('updateVideoTraining');

    Route::get('/setting/help-line','SettingController@showHelpLine')->name('showHelpLine');
    Route::post('/setting/help-line','SettingController@updateHelpLine')->name('updateHelpLine');

    Route::get('/setting/about','SettingController@showAbout')->name('showAbout');
    Route::post('/setting/about','SettingController@updateAbout')->name('updateAbout');

    Route::get('/setting/faq','SettingController@showFaq')->name('showFaq');
    Route::post('/setting/faq','SettingController@updateFaq')->name('updateFaq');

    Route::get('/setting/terms-and-condition','SettingController@showTermsAndCondition')->name('showTermsAndCondition');
    Route::post('/setting/terms-and-condition','SettingController@updateTermsAndCondition')->name('updateTermsAndCondition');

    Route::get('/setting/privacy-policy','SettingController@showPrivacyPolicy')->name('showPrivacyPolicy');
    Route::post('/setting/privacy-policy','SettingController@updatePrivacyPolicy')->name('updatePrivacyPolicy');

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
    Route::get('/notifications','NotificationController@index')->name('notifications');

    Route::resource('home', 'HomeController')->except(['create','store', 'show', 'edit', 'update', 'destroy']);
    Route::get('/show-job/{id}', 'HomeController@showJob')->name('showJob');
    Route::get('/show-services/{id}', 'HomeController@showServices')->name('showServices');

    //Profile
    Route::get('/profile','ProfileController@index')->name('profile.index');

    //Worker bid on customer gig
    Route::post('/bid','WorkerBidController@store')->name('storeWorkerBid');
    Route::get('/bid/{id}','WorkerBidController@show')->name('showWorkerBid');
    Route::post('/bid/cancel/','WorkerBidController@cancel')->name('cancelWorkerBid');
    Route::post('/bid/change-budget/','WorkerBidController@changePriceForMoreWork')->name('changePriceForMoreWork');

    //Customer bid on worker gig
    Route::get('/customer/bid/{id}', 'CustomerBidController@show')->name('showCustomerBid');
    Route::post('/customer/bid/price-change', 'CustomerBidController@updateCustomerBidBudget')->name('updateCustomerBidBudget');
    Route::post('/customer/bid/accept', 'CustomerBidController@acceptCustomerBid')->name('acceptCustomerBid');
    Route::post('/customer/bid/reject', 'CustomerBidController@rejectCustomerBid')->name('rejectCustomerBid');

    //Worker created gig
    Route::get('/gig', 'WorkerGigController@index')->name('gig.index');
    Route::post('/gig', 'WorkerGigController@store')->name('gig.store');
    Route::get('/gig/{id}', 'WorkerGigController@show')->name('showWorkerGig');
    Route::get('/gig/edit/{id}', 'WorkerGigController@edit')->name('editWorkerGig');
    Route::post('/gig/edit', 'WorkerGigController@update')->name('updateWorkerGig');
    Route::post('/gig/delete', 'WorkerGigController@delete')->name('deleteWorkerGig');



    //Route::resource('gig', 'GigController')->except(['create', 'edit', 'update', 'destroy']);

    Route::resource('job', 'JobController')->except(['create', 'update', 'destroy']);


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

    Route::get('/notifications','NotificationController@index')->name('notifications');
    //Home
    Route::get('/','HomeController@index')->name('home.index');
    Route::post('/','CustomerGigController@store')->name('storeCustomerGig');
    Route::get('/services/{id}','HomeController@showServices')->name('showServices');

    //Home>Next
    Route::get('/gig/{id}','WorkerGigController@show')->name('showGigs');
    Route::get('/gig-detail/{id}','WorkerGigController@showGigDetail')->name('showGigDetail');
    Route::get('/gig-detail/order/{id}','WorkerGigController@showOrderForm')->name('showGigOrderForm');

    //Profile
    Route::get('/profile','ProfileController@index')->name('profile.index');

    //My Order
    //Customer gig | Worker Bids
    Route::get('/jobs','JobController@index')->name('myJob');

    Route::get('/job/customer-gig/{id}','CustomerGigController@show')->name('showCustomerGig');
    Route::post('/job/customer-gig','CustomerGigController@selectWorker')->name('selectWorkerForCustomerGig');
    Route::post('/job/customer-gig/cancel','CustomerGigController@cancel')->name('cancelCustomerGig');
    Route::post('/job/customer-gig/price-change','CustomerGigController@changePriceForMoreWork')->name('changePriceForMoreWork');
    Route::post('/job/customer-gig/image-upload','CustomerGigController@imageUploadToJob')->name('imageUploadToCustomerGig');
    Route::post('/job/customer-gig/complete-rating','CustomerGigController@completedJobAndRating')->name('completedCustomerGigJobAndRating');

    //Customer's Bid
    Route::post('/gig-detail/order','CustomerBidController@store')->name('submitGigOrderForm'); //Home: category>service>worker-gig>order-form>submit
    Route::get('/job/bid/{id}','CustomerBidController@show')->name('showCustomerBid');
    Route::post('/job/bid/cancel','CustomerBidController@cancel')->name('cancelCustomerBid');
    Route::post('/job/bid/budget','CustomerBidController@updateBudget')->name('updateCustomerBidBudget');
    Route::post('/job/bid/image-upload','CustomerBidController@imageUploadToJob')->name('imageUploadToCustomerBid');
    Route::post('/job/bid/complete-rating','CustomerBidController@completedJobAndRating')->name('completedCustomerBidJobAndRating');

    //General
    Route::get('/general-services', 'GeneralServiceController@showGeneralServiceCategory')->name('showGeneralServiceCategory');
    Route::get('/general-services/{id}','GeneralServiceController@showMembershipServices')->name('showMembershipServices');
    Route::get('/members/{id}','GeneralServiceController@showMembers')->name('showMembers');

});

//Payment gateway
Route::group(['namespace' => 'PaymentGateway', 'as' => '', 'prefix'=>'', 'middleware'=>['auth']], function (){
    Route::get('/payment/{amount}', 'ShurjoPayController@getPaymentView')->name('shurjopay.getPaymentView');
    Route::get('/payment-success', 'ShurjoPayController@getPaymentSuccessView')->name('shurjopay.getPaymentSuccessView');
    Route::post('/response', 'smasif\ShurjopayLaravelPackage\ShurjopayController@response')->name('shurjopay.response');
});
