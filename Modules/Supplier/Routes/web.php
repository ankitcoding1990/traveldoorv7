<?php

use Illuminate\Support\Facades\Route;
use Modules\Supplier\Http\Controllers\ActivityServiceController;

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

Route::prefix('supplier')->group(function() {

    Route::get('/register','Auth\RegisterController@showRegistrationForm')->name('supplier.register');
    Route::post('/register','Auth\RegisterController@create')->name('supplier.create');
    Route::put('/{id}/update','Auth\RegisterController@update')->name('supplier.update');
    Route::get('/logout','Auth\LogoutController@logout')->name('supplier.logout');
    Route::get('/login','Auth\LoginController@showLoginForm')->name('supplier.login');
    Route::post('/login','Auth\LoginController@login')->name('supplier.login');
    Route::resource('profile', 'SupplierController', [
        'names' =>  [
            'edit' => 'supplier.profile.edit',
            'show' => 'supplier.profile.show',
            'update' => 'supplier.profile.update',
            'index' => 'supplier.profile.index',
          ]
    ]);
    // Route::resource('hotel', 'HotelServiceController');
   Route::group(['module' => 'sightseeing'], function(){
    Route::resource('sightseeing', 'SightSeeingServiceController');

     Route::get('sightseeing/{id}/description','SightSeeingServiceController@descriptionCreate')->name('sightseeing.description.create');
        Route::post('sightseeing/{id}/description','SightSeeingServiceController@descriptionStore')->name('sightseeing.description.store');
        Route::get('sightseeing/{id}/images','SightSeeingServiceController@imagesUploadIndex')->name('sightseeing.images.upload');
        Route::post('sightseeing/{id}/images','SightSeeingServiceController@imagesStore')->name('sightseeing.images.store');
        Route::get('sightseeing/{id}/prices','SightSeeingServiceController@pricesCreate')->name('sightseeing.prices.create');
        Route::post('sightseeing/{id}/prices','SightSeeingServiceController@pricesStore')->name('sightseeing.prices.store');
        Route::get('sightseeing/prices/edit','SightSeeingServiceController@pricesEdit')->name('sightseeing.prices.edit');
        Route::get('sightseeing/drafted/list','SightSeeingServiceController@drafted')->name('sightseeing.drafted');
   });
    Route::group(['module' => 'activity'],function(){
        // Main Routes
        Route::resource('activity','ActivityServiceController');
        Route::get('activity-draft','ActivityServiceController@draftedIndex');
        // Create Routes
        Route::get('activity/{id}/pricing','ActivityServiceController@pricingCreate')->name('supplier.activity.prices.create');
        Route::post('activity/pricing','ActivityServiceController@pricingStore')->name('supplier.activity.prices.store');
        Route::get('activity/{id}/booking','ActivityServiceController@bookingCreate')->name('supplier.activity.booking.create');
        Route::post('activity/booking','ActivityServiceController@bookingStore')->name('supplier.activity.booking.store');
        Route::get('activity/{id}/images','ActivityServiceController@imagesCreate')->name('supplier.activity.images.create');
        Route::post('activity/images','ActivityServiceController@imagesStore')->name('supplier.activity.images.store');
        Route::get('activity/{id}/description','ActivityServiceController@descriptionCreate')->name('supplier.activity.description.create');
        Route::post('activity/description','ActivityServiceController@descriptionStore')->name('supplier.activity.description.store');
        // Edit Routes
        Route::get('activity/{id}/pricing/edit','ActivityServiceController@pricingEdit')->name('supplier.activity.prices.edit');
        Route::put('activity/pricing/{id}','ActivityServiceController@pricingUpdate')->name('supplier.activity.prices.update');
        Route::get('activity/{id}/booking/edit','ActivityServiceController@bookingEdit')->name('supplier.activity.booking.edit');
        Route::put('activity/booking/{id}','ActivityServiceController@bookingUpdate')->name('supplier.activity.booking.update');
        Route::get('activity/{id}/images/edit','ActivityServiceController@imagesEdit')->name('supplier.activity.images.edit');
        Route::match(['post','put'], 'activity/images/update','ActivityServiceController@imageUpdate')->name('supplier.activity.images.update');
        Route::get('activity/{id}/description/edit', 'ActivityServiceController@descriptionEdit')->name('supplier.activity.description.edit');
        Route::put('activity/description/update/{id}', 'ActivityServiceController@descriptionUpdate')->name('supplier.activity.description.update');
    });

    Route::group(['module' => 'restaurant'], function(){
        Route::resource('restaurant','RestaurantServiceController');
        Route::get('restaurant/drafted/list','RestaurantServiceController@index_drafted')->name('supplier.restaurant.drafted');
        Route::get('restaurant/{id}/images/create','RestaurantServiceController@create_image')->name('supplier.restaurant.images.create');
        Route::get('restaurant/{id}/images/edit','RestaurantServiceController@edit_image')->name('supplier.restaurant.images.edit');
        Route::get('restaurant/{id}/images/store','RestaurantServiceController@store_image')->name('restaurant.images.store');
    });

    // Route::get('/profile','SupplierController@profileIndex')->name('supplier.profile');
    Route::get('/bank','SupplierBankController@index')->name('supplier.bank');
    //Route::post('/bank','SupplierBankController@store')->name('banks.store');
    Route::get('/edit/bank','SupplierBankController@edit')->name('bank.edit');
    //Route::post('/edit/{$id}/bank','SupplierBankController@update')->name('bank.update');
    Route::resource('sbanks', 'SupplierBankController');
    Route::resource('scontact','SupplierContactController');
    Route::resource('sreset', 'SupplierPasswordChangeController');
    Route::resource('services', 'SupplierServicesController');

    Route::group(['name' => 'dashboard'], function(){
        Route::get('/', 'SupplierController@indexDashboard')->name('supplier.dashboard');
        Route::post('/bank_store','SupplierController@bankStore')->name('supplier.bankStore');
    });
});
