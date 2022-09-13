<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\SetLocale;

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

//Route::get('/', function () {
//    return view('welcome');
//});
//
//
//Route::get('/admin/login', function () {
//    return view('dashboard.login.login');
//});
//
//Route::get('/admin/dashboard', function () {
//    return view('dashboard.pages.home.dashboard');
//});
Route::get('/get-distance-providers/{distance}/{order}', 'App\Http\Controllers\Dashboard\OrdersManagementController@getDistanceTechnicians');

Route::get('/', 'App\Http\Controllers\Dashboard\AdminsController@login_form')->name('login');
Route::post('/login', 'App\Http\Controllers\Dashboard\AdminsController@login')->name('admins.login');
Route::get('/logout', 'App\Http\Controllers\Dashboard\AdminsController@logout')->name('logout');
Route::get('admin/profile', 'App\Http\Controllers\Dashboard\AdminsController@profileIndex')->name('admins.profile');
Route::post('admins/profile/{id}', 'App\Http\Controllers\Dashboard\AdminsController@updateProfile')->name('admins.profile.update');

Route::middleware([SetLocale::class])->group(function () {
    Route::get('/{lang}', function ($lang) {
        $lang == 'en' ? Session::put('lang', 'ar') : Session::put('lang', 'en');
        return back();
    });
});
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'auth:admin'], function () {
//        Route::group(['middleware' => ['role:Super Admin|Settings Admin']], function () {

        Route::resource('dashboard', 'App\Http\Controllers\Dashboard\StatisticsController')->only('index');

        Route::resource('settings', 'App\Http\Controllers\Dashboard\SettingsController')->only('index', 'create', 'store', 'edit', 'update', 'destroy');

        Route::get('ads/dataTable', 'App\Http\Controllers\Dashboard\AdsController@dataTable');
        Route::resource('ads', 'App\Http\Controllers\Dashboard\AdsController');
        Route::get('ads/{ad}/delete', 'App\Http\Controllers\Dashboard\AdsController@destroy');
        Route::post('ads/update/{id}', 'App\Http\Controllers\Dashboard\AdsController@update')->name('ads.update');
        Route::get('ads/activate/{id}', 'App\Http\Controllers\Dashboard\AdsController@activate')->name('ads.activate');
        Route::get('ads/deactivate/{id}', 'App\Http\Controllers\Dashboard\AdsController@deactivate')->name('ads.deactivate');

        Route::get('contacts/dataTable', 'App\Http\Controllers\Dashboard\ContactsController@dataTable');
        Route::resource('contacts', 'App\Http\Controllers\Dashboard\ContactsController');
        Route::get('contacts/{contact}/delete', 'App\Http\Controllers\Dashboard\ContactsController@destroy');
        Route::post('contacts/read/{id}', 'App\Http\Controllers\Dashboard\ContactsController@read')->name('contacts.read');
        Route::get('contacts/{id}/reply', 'App\Http\Controllers\Dashboard\ContactsController@replyForm')->name('contacts.reply');
        Route::post('contacts/reply/store/{id}', 'App\Http\Controllers\Dashboard\ChatController@storeReply')->name('contacts.store.reply');


        Route::get('countries/dataTable', 'App\Http\Controllers\Dashboard\CountriesController@dataTable');
        Route::resource('countries', 'App\Http\Controllers\Dashboard\CountriesController');
        Route::get('countries/{country}/delete', 'App\Http\Controllers\Dashboard\CountriesController@destroy');
        Route::post('countries/update/{id}', 'App\Http\Controllers\Dashboard\CountriesController@update')->name('countries.update');
        Route::get('countries/activate/{id}', 'App\Http\Controllers\Dashboard\CountriesController@activate')->name('countries.activate');
        Route::get('countries/deactivate/{id}', 'App\Http\Controllers\Dashboard\CountriesController@deactivate')->name('countries.deactivate');

        Route::get('instructions/dataTable', 'App\Http\Controllers\Dashboard\InstructionsController@dataTable');
        Route::resource('instructions', 'App\Http\Controllers\Dashboard\InstructionsController');
        Route::get('instructions/{instruction}/delete', 'App\Http\Controllers\Dashboard\InstructionsController@destroy');
        Route::post('instructions/update/{id}', 'App\Http\Controllers\Dashboard\InstructionsController@update')->name('instructions.update');
        Route::get('instructions/activate/{id}', 'App\Http\Controllers\Dashboard\InstructionsController@activate')->name('instructions.activate');
        Route::get('instructions/deactivate/{id}', 'App\Http\Controllers\Dashboard\InstructionsController@deactivate')->name('instructions.deactivate');

        Route::get('reasons/dataTable', 'App\Http\Controllers\Dashboard\ReasonsController@dataTable');
        Route::resource('reasons', 'App\Http\Controllers\Dashboard\ReasonsController');
        Route::get('reasons/{reason}/delete', 'App\Http\Controllers\Dashboard\ReasonsController@destroy');
        Route::post('reasons/update/{id}', 'App\Http\Controllers\Dashboard\ReasonsController@update')->name('reasons.update');
        Route::get('reasons/activate/{id}', 'App\Http\Controllers\Dashboard\ReasonsController@activate')->name('reasons.activate');
        Route::get('reasons/deactivate/{id}', 'App\Http\Controllers\Dashboard\ReasonsController@deactivate')->name('reasons.deactivate');


        Route::get('services/dataTable', 'App\Http\Controllers\Dashboard\ServicesController@dataTable');
        Route::resource('services', 'App\Http\Controllers\Dashboard\ServicesController');
        Route::get('services/{service}/delete', 'App\Http\Controllers\Dashboard\ServicesController@destroy');
        Route::post('services/update/{id}', 'App\Http\Controllers\Dashboard\ServicesController@update')->name('services.update');
        Route::get('services/activate/{id}', 'App\Http\Controllers\Dashboard\ServicesController@activate')->name('services.activate');
        Route::get('services/deactivate/{id}', 'App\Http\Controllers\Dashboard\ServicesController@deactivate')->name('services.deactivate');

        Route::get('packages/dataTable', 'App\Http\Controllers\Dashboard\PackagesController@dataTable');
        Route::resource('packages', 'App\Http\Controllers\Dashboard\PackagesController');
        Route::get('packages/{package}/delete', 'App\Http\Controllers\Dashboard\PackagesController@destroy');
        Route::post('packages/update/{id}', 'App\Http\Controllers\Dashboard\PackagesController@update')->name('packages.update');
        Route::get('packages/activate/{id}', 'App\Http\Controllers\Dashboard\PackagesController@activate')->name('packages.activate');
        Route::get('packages/deactivate/{id}', 'App\Http\Controllers\Dashboard\PackagesController@deactivate')->name('packages.deactivate');

        Route::get('offers/dataTable', 'App\Http\Controllers\Dashboard\OffersController@dataTable');
        Route::resource('offers', 'App\Http\Controllers\Dashboard\OffersController');
        Route::get('offers/{offer}/delete', 'App\Http\Controllers\Dashboard\OffersController@destroy');
        Route::post('offers/update/{id}', 'App\Http\Controllers\Dashboard\OffersController@update')->name('offers.update');
        Route::get('offers/activate/{id}', 'App\Http\Controllers\Dashboard\OffersController@activate')->name('offers.activate');
        Route::get('offers/deactivate/{id}', 'App\Http\Controllers\Dashboard\OffersController@deactivate')->name('offers.deactivate');


        Route::get('users/dataTable', 'App\Http\Controllers\Dashboard\UsersController@dataTable');
        Route::resource('users', 'App\Http\Controllers\Dashboard\UsersController');
        Route::get('users/{user}/delete', 'App\Http\Controllers\Dashboard\UsersController@destroy');
        Route::get('users/excel/export', 'App\Http\Controllers\Dashboard\UsersController@export')->name('users.export');
        Route::get('users/{user}/show', 'App\Http\Controllers\Dashboard\UsersController@show')->name('users.show');
        Route::get('users/activate/{id}', 'App\Http\Controllers\Dashboard\UsersController@activate')->name('users.activate');
        Route::get('users/deactivate/{id}', 'App\Http\Controllers\Dashboard\UsersController@deactivate')->name('users.deactivate');
        Route::post('users/delete/all', 'App\Http\Controllers\Dashboard\UsersController@deleteAll')->name('users.all.delete');
        Route::post('users/update/{id}', 'App\Http\Controllers\Dashboard\UsersController@update')->name('users.update');


        Route::get('providers/dataTable', 'App\Http\Controllers\Dashboard\ProvidersController@dataTable');
        Route::resource('providers', 'App\Http\Controllers\Dashboard\ProvidersController');
        Route::get('providers/{provider}/delete', 'App\Http\Controllers\Dashboard\ProvidersController@destroy');
        Route::get('providers/excel/export', 'App\Http\Controllers\Dashboard\ProvidersController@export')->name('providers.export');
        Route::get('providers/{provider}/show', 'App\Http\Controllers\Dashboard\ProvidersController@show')->name('providers.show');
        Route::get('providers/activate/{id}', 'App\Http\Controllers\Dashboard\ProvidersController@activate')->name('providers.activate');
        Route::get('providers/deactivate/{id}', 'App\Http\Controllers\Dashboard\ProvidersController@deactivate')->name('providers.deactivate');
        Route::post('providers/delete/all', 'App\Http\Controllers\Dashboard\ProvidersController@deleteAll')->name('providers.all.delete');
        Route::post('providers/update/{id}', 'App\Http\Controllers\Dashboard\ProvidersController@update')->name('providers.update');


        Route::get('orders/dataTable', 'App\Http\Controllers\Dashboard\OrdersController@dataTable');
        Route::resource('orders', 'App\Http\Controllers\Dashboard\OrdersController');
        Route::get('orders/excel/export', 'App\Http\Controllers\Dashboard\OrdersController@export')->name('orders.export');
        Route::get('orders/invoice/{id}', 'App\Http\Controllers\Dashboard\OrdersController@orderInvoice')->name('orders.invoice');
        Route::get('orders/invoice/{id}/download', 'App\Http\Controllers\Dashboard\OrdersController@generatePdf')->name('orders.invoice.download');
        Route::get('orders/{order}/delete', 'App\Http\Controllers\Dashboard\OrdersController@destroy');
        Route::post('orders/delete/all', 'App\Http\Controllers\Dashboard\OrdersController@deleteAll')->name('orders.all.delete');

        Route::get('orders-management/dataTable', 'App\Http\Controllers\Dashboard\OrdersManagementController@dataTable');
        Route::resource('orders-management', 'App\Http\Controllers\Dashboard\OrdersManagementController');
        Route::get('orders-management/excel/export', 'App\Http\Controllers\Dashboard\OrdersManagementController@export')->name('orders-management.export');
        Route::get('orders-management/invoice/{id}', 'App\Http\Controllers\Dashboard\OrdersManagementController@orderInvoice')->name('orders-management.invoice');
        Route::get('orders-management/invoice/{id}/download', 'App\Http\Controllers\Dashboard\OrdersManagementController@generatePdf')->name('orders-management.invoice.download');
        Route::get('orders-management/{order}/delete', 'App\Http\Controllers\Dashboard\OrdersManagementController@destroy');
        Route::post('orders-management/delete/all', 'App\Http\Controllers\Dashboard\OrdersManagementController@deleteAll')->name('orders-management.all.delete');
        Route::post('orders-management/update/{id}', 'App\Http\Controllers\Dashboard\OrdersManagementController@update')->name('orders-management.update');


        Route::get('notifications/dataTable', 'App\Http\Controllers\Dashboard\NotificationsController@dataTable');
        Route::resource('notifications', 'App\Http\Controllers\Dashboard\NotificationsController');
//            Route::get('notifications/{notification}/delete', 'App\Http\Controllers\Dashboard\NotificationsController@destroy');

        Route::get('socials/dataTable', 'App\Http\Controllers\Dashboard\SocialsController@dataTable');
        Route::resource('socials', 'App\Http\Controllers\Dashboard\SocialsController');
        Route::get('socials/{ad}/delete', 'App\Http\Controllers\Dashboard\SocialsController@destroy');
        Route::post('socials/update/{id}', 'App\Http\Controllers\Dashboard\SocialsController@update')->name('socials.update');


//        Route::group(['middleware' => ['role:Super Admin']], function () {
        Route::get('admins/dataTable', 'App\Http\Controllers\Dashboard\AdminsController@dataTable');
        Route::resource('admins', 'App\Http\Controllers\Dashboard\AdminsController');
        Route::get('admins/{admin}/delete', 'App\Http\Controllers\Dashboard\AdminsController@destroy');
        Route::post('admins/update/{id}', 'App\Http\Controllers\Dashboard\AdminsController@update')->name('admins.update');

        Route::get('roles/dataTable', 'App\Http\Controllers\Dashboard\RolesController@dataTable');
        Route::resource('roles', 'App\Http\Controllers\Dashboard\RolesController');
        Route::get('roles/{role}/delete', 'App\Http\Controllers\Dashboard\RolesController@destroy');
        Route::post('roles/update/{id}', 'App\Http\Controllers\Dashboard\RolesController@update')->name('roles.update');

        Route::get('packages-services/dataTable', 'App\Http\Controllers\Dashboard\PackageServicesController@dataTable');
        Route::resource('packages-services', 'App\Http\Controllers\Dashboard\PackageServicesController');
        Route::get('packages-services/{id}/delete', 'App\Http\Controllers\Dashboard\PackageServicesController@destroy');
        Route::post('packages-services/update/{id}', 'App\Http\Controllers\Dashboard\PackageServicesController@update')->name('packages.services.update');

        // });
    });
});


Route::get('getnotification', function () {
    dd(pushnotification('cnlv-_PjSy28Q4KAMLos9J:APA91bGvgszzHNEgU1rdTan8lxrobsHppaQBqpK1Da-sYhf3u9TGZxzPSinfH2AhD0RdCqJ9mjEaEQRU0owWfUE9TQ9Aas9vPQKQyhPCZjjWdS-tCg6d6hgTcMAOfMJFwG4w8P9CJAWB',
        "type 1", "type 1", "1", "1"));
});
