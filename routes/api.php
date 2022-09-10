<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => ['localization'],'prefix' => 'mobile'], function () {
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/loginterms','App\Http\Controllers\Apis\Mobile\SettingsController@getLoginTerms');
        Route::get('/about', 'App\Http\Controllers\Apis\Mobile\SettingsController@getAboutUs');
        Route::get('/terms','App\Http\Controllers\Apis\Mobile\SettingsController@getTerms');
        Route::get('/privacy','App\Http\Controllers\Apis\Mobile\SettingsController@getPrivacy');
        Route::get('/socialmedia','App\Http\Controllers\Apis\Mobile\SettingsController@getSocialMedia');
        Route::get('/getreasons','App\Http\Controllers\Apis\Mobile\SettingsController@getReasons');
        Route::get('/getservices','App\Http\Controllers\Apis\Mobile\SettingsController@getServices');
        Route::get('/getcountries','App\Http\Controllers\Apis\Mobile\SettingsController@getCountries');
        Route::get('/getproviderstypes','App\Http\Controllers\Apis\Mobile\SettingsController@getProviderTypes');
        Route::get('/getisntructions','App\Http\Controllers\Apis\Mobile\SettingsController@getInstructions');
		Route::get('/getversion','App\Http\Controllers\Apis\Mobile\SettingsController@checkVersion');
        Route::group(['middleware' => 'auth:sanctum'], function(){
            Route::post('/contactus','App\Http\Controllers\Apis\Mobile\SettingsController@insertContactForm');
            Route::get('/notifications','App\Http\Controllers\Apis\Mobile\SettingsController@getAllNotifications');
            Route::get('/avaialability/notifications-count','App\Http\Controllers\Apis\Mobile\SettingsController@config');
        });
     });
    Route::group(['prefix' => 'provider'], function () {
        Route::post('/signup','App\Http\Controllers\Apis\Mobile\Provider\AuthController@signUp');
        Route::post('/verifycode','App\Http\Controllers\Apis\Mobile\Provider\AuthController@verifyCode');
        Route::post('/login','App\Http\Controllers\Apis\Mobile\Provider\AuthController@login');

        Route::group(['middleware' => 'auth:sanctum'], function(){
            Route::post('/logout', 'App\Http\Controllers\Apis\Mobile\Provider\AuthController@logout');
            Route::get('/getprofile', 'App\Http\Controllers\Apis\Mobile\Provider\AuthController@providerProfile');
            Route::post('/updateprofile','App\Http\Controllers\Apis\Mobile\Provider\AuthController@updateProviderProfile');
            Route::post('/updatefirebase','App\Http\Controllers\Apis\Mobile\Provider\AuthController@updateProviderFirebase');
            Route::post('/onlineoffline','App\Http\Controllers\Apis\Mobile\Provider\AuthController@onlineOffline');
            Route::post('/updatelocation','App\Http\Controllers\Apis\Mobile\Provider\AuthController@updateLocation');


            Route::get('/home','App\Http\Controllers\Apis\Mobile\Provider\ProviderBookingController@getHome');
            Route::get('/order/{id}','App\Http\Controllers\Apis\Mobile\Provider\ProviderBookingController@getOrder');
            Route::get('/allorders','App\Http\Controllers\Apis\Mobile\Provider\ProviderBookingController@getOrders');
            Route::post('/accept/order','App\Http\Controllers\Apis\Mobile\Provider\ProviderBookingController@acceptOrder');
            Route::post('/reject/order','App\Http\Controllers\Apis\Mobile\Provider\ProviderBookingController@rejectOrder');
            Route::post('/evaluation','App\Http\Controllers\Apis\Mobile\Provider\ProviderBookingController@rateOrder');

            Route::get('/allworks','App\Http\Controllers\Apis\Mobile\Provider\WorksController@getWorks');
            Route::post('/storeworks','App\Http\Controllers\Apis\Mobile\Provider\WorksController@storeWorks');
            Route::post('/deletework','App\Http\Controllers\Apis\Mobile\Provider\WorksController@deleteWork');

            Route::get('/allreviews','App\Http\Controllers\Apis\Mobile\Provider\ProviderBookingController@getReviews');
            Route::get('/wallet','App\Http\Controllers\Apis\Mobile\Provider\ProviderBookingController@getWallet');
            Route::post('/withdraw','App\Http\Controllers\Apis\Mobile\Provider\ProviderBookingController@withdraw');
            Route::post('/location','App\Http\Controllers\Apis\Mobile\Provider\AuthController@sendLocation');
            Route::post('/arrived','App\Http\Controllers\Apis\Mobile\Provider\ProviderBookingController@arrived');

            Route::post('/finish/order','App\Http\Controllers\Apis\Mobile\Provider\ProviderBookingController@finishOrder');

        });
    });

    Route::group(['prefix' => 'user'], function () {
        Route::post('/signup','App\Http\Controllers\Apis\Mobile\User\AuthController@signUp');
        Route::post('/verifycode','App\Http\Controllers\Apis\Mobile\User\AuthController@verifyCode');
        Route::post('/login','App\Http\Controllers\Apis\Mobile\User\AuthController@login');
        Route::get('/packages','App\Http\Controllers\Apis\Mobile\User\PackageController@getPackages');
        Route::get('/getpackage/{package_id}','App\Http\Controllers\Apis\Mobile\User\PackageController@packageData');
        Route::get('/offers','App\Http\Controllers\Apis\Mobile\User\OffersController@getOffers');
        Route::get('/offer/{offer_id}','App\Http\Controllers\Apis\Mobile\User\OffersController@offerData');
        Route::post('/qrcode','App\Http\Controllers\Apis\Mobile\User\BookingController@checkQrCode');


        Route::group(['middleware' => 'auth:sanctum'], function(){
            Route::get('/home','App\Http\Controllers\Apis\Mobile\User\BookingController@getHome');
            Route::post('/logout', 'App\Http\Controllers\Apis\Mobile\User\AuthController@logout');
            Route::get('/getprofile', 'App\Http\Controllers\Apis\Mobile\User\AuthController@userProfile');
            Route::post('/updateprofile','App\Http\Controllers\Apis\Mobile\User\AuthController@updateUserProfile');
            Route::post('/updatefirebase','App\Http\Controllers\Apis\Mobile\User\AuthController@updateUserFirebase');
            Route::get('/allproviders/services/{service_id}','App\Http\Controllers\Apis\Mobile\User\BookingController@getAllProvidersService');
            Route::get('/providerdetails/{provider_id}','App\Http\Controllers\Apis\Mobile\User\BookingController@providerData');
            Route::get('/getfav','App\Http\Controllers\Apis\Mobile\User\BookingController@getFavoriteList');
            Route::post('/addfav','App\Http\Controllers\Apis\Mobile\User\BookingController@addFavorite');
            Route::post('/deletefav','App\Http\Controllers\Apis\Mobile\User\BookingController@deleteFav');
            Route::post('/createorder','App\Http\Controllers\Apis\Mobile\User\BookingController@createOrder');
            Route::get('/order/{order_id}','App\Http\Controllers\Apis\Mobile\User\BookingController@getOrderDetails');
            Route::get('/orders','App\Http\Controllers\Apis\Mobile\User\BookingController@getOrders');
            Route::post('/evaluation','App\Http\Controllers\Apis\Mobile\User\BookingController@rateOrder');
            Route::post('/cancel/order','App\Http\Controllers\Apis\Mobile\User\BookingController@cancelOrder');
            Route::get('/wallet','App\Http\Controllers\Apis\Mobile\User\BookingController@getWallet');
            Route::post('/withdraw','App\Http\Controllers\Apis\Mobile\User\BookingController@withdraw');
            Route::post('/finish/order','App\Http\Controllers\Apis\Mobile\User\BookingController@finishOrder');
            Route::get('/order/summary/{id}','App\Http\Controllers\Apis\Mobile\User\BookingController@summary');
            Route::post('/checkout','App\Http\Controllers\Apis\Mobile\User\BookingController@checkout');

        });
    });
});
