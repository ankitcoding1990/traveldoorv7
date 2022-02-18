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

Route::prefix('agent')->group(function() {
    //Agent Login
    Route::get('/login','Auth\LoginController@showLoginForm')->name('agent.login');
    Route::post('/login','Auth\LoginController@login')->name('agent.login');
    Route::get('/logout', 'Auth\LogoutController@logout')->name('agent.logout');
    Route::get('/register','Auth\RegisterController@showRegistrationForm')->name('agent.register');
    Route::post('/register','Auth\RegisterController@create')->name('agent.register');
    Route::put('profile/{id}/update','Auth\RegisterController@update')->name('agent.profile.update');

    Route::get('/forget-password','Auth\ForgotPasswordController@ForgetPassword')->name('agent.forget-password');
    Route::post('/forget-password','Auth\ForgotPasswordController@reset')->name('agent.forget-password');
    Route::get('/reset-password','Auth\ForgotPasswordController@ForgetPasswordMail')->name('agent.forget-password-mail');
    Route::post('/reset-password','Auth\ResetPasswordController@RestPassword')->name('agent.reset-password');
// Agent LoginEnd

    Route::group(['name' => 'dashboard'], function(){
      // agent dashboard
        Route::get('/', 'AgentController@index')->name('agent.dashboard');

        Route::group(['role' => 'agentProfile'], function(){
          Route::resource('profile', 'AgentProfileController', [
            'names' =>  [
              'edit' => 'agent.profile.edit',
              'show' => 'agent.profile.show',
              //'update' => 'agent.profile.update',
            ]
          ])->only(['show', 'update', 'edit']);
          //Route::resource('abanks', 'SupplierBankController');
          Route::get('profile/{id}/banks', 'AgentProfileController@banks')->name('agent.profile.banks');
          Route::get('profile/{id}/services', 'AgentProfileController@services')->name('agent.profile.services');
          Route::get('profile/{id}/contacts', 'AgentProfileController@contacts')->name('agent.profile.contacts');
          Route::get('profile/{id}/password', 'AgentProfileController@password')->name('agent.profile.password');

        });

    });

    Route::group(['prefix' => 'activity'],function(){
        Route::get('search','ActivityController@search')->name('agent.activity.search');
        Route::post('get','ActivityController@getActivities')->name('agent.activities');
        Route::get('detail/{activity_id}','ActivityController@show')->name('agent.activity.detail');
    });

    Route::group(['prefix' => 'hotel'],function(){
        Route::get('search','ActivityController@search')->name('agent.hotel.search');
    });
    Route::group(['prefix' => 'guide'],function(){
        Route::get('search','ActivityController@search')->name('agent.guide.search');
    });
    Route::group(['prefix' => 'driver'],function(){
        Route::get('search','ActivityController@search')->name('agent.driver.search');
    });
    Route::group(['prefix' => 'restaurant'],function(){
        Route::get('search','RestaurantController@index')->name('agent.restaurant.search');
        Route::post('filter','RestaurantController@search')->name('agent.restaurant.filter');
        Route::get('detail/{restaurant_id}','RestaurantController@show')->name('agent.restaurant.detail');
    });
    Route::group(['prefix' => 'transfer'],function(){
        Route::get('search','ActivityController@search')->name('agent.transfer.search');
    });
    Route::group(['prefix' => 'itinerary'],function(){
        Route::get('search','ActivityController@search')->name('agent.itinerary.search');
    });
    Route::group(['prefix' => 'sightseeing'],function(){
        Route::get('search','ActivityController@search')->name('agent.sightseeing.search');
    });

    Route::get('/markup','SettingsController@MarkupIndex');

    Route::post('/markup/update','SettingsController@MarkupUpdate');

});
