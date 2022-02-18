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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getCountries','ApiController@getCountries')->name('getCountries');
Route::get('getActivityType','ApiController@getActivityType')->name('getActivityType');
Route::get('getLanguages','ApiController@getLanguages')->name('getLanguages');
Route::post('getCities','ApiController@getCities')->name('getCities');
Route::get('getAirports','ApiController@getAirports')->name('getAirports');

Route::post('specialoffers','ApiController@insert_special_offer')->name('specialoffers');


Route::post('specialbooking','ApiController@insert_special_offer_booking')->name('specialbooking');

Route::post('get-driver-id','ApiController@getdriverid')->name('get-driver-id');

//tour-enquiry
Route::post('tourenquiry','ApiController@tour_enquiry')->name('tourenquiry');
//currency
Route::post('get-currency-new','ApiController@convertCurrency')->name('get-currency-new');


//currencyCOnversion
Route::post('CurrenctConversion','ApiController@convertCurrency')->name('CurrenctConversion');



Route::get('activity/fetchActivites','ApiController@fetchActivites')->name('fetchActivites');
Route::post('activity/filteredfetchActivites','ApiController@filteredfetchActivites')->name('filteredfetchActivites');
Route::post('activity/fetchActivitiesPricing','ApiController@fetchActivitiesPricing')->name('fetchActivitiesPricing');
Route::post('activity/fetchActivitiesAvailability','ApiController@fetchActivitiesAvailability')->name('fetchActivitiesAvailability');
Route::post('activity/activityDetailView','ApiController@activityDetailView')->name('activityDetailView');
Route::post('activity/activityBooked','ApiController@activityBooked')->name('activityBooked');


Route::get('hotel/fetchHotels','ApiController@fetchHotels')->name('fetchHotels');
Route::get('getHotelType','ApiController@getHotelType')->name('getHotelType');
Route::post('hotel/filteredfetchHotels','ApiController@filteredfetchHotels')->name('filteredfetchHotels');
Route::post('hotel/hotelDetailView','ApiController@hotelDetailView')->name('hotelDetailView');
Route::post('hotel/hotelBooked','ApiController@hotelBooked')->name('hotelBooked');
Route::post('hotel/itinerarygethotelpax','ApiController@itinerary_get_hotel_pax')->name('itinerarygethotelpax');
Route::post('hotel/itinerarygethotelsame','ApiController@itinerary_get_hotel_same')->name('itinerarygethotelsame');

//hotel avaialble
Route::post('hotelavailability','ApiController@hotelavailability')->name('hotelavailability');

Route::get('guide/fetchGuides','ApiController@fetchGuides')->name('fetchGuides');
Route::post('guide/filteredfetchGuides','ApiController@filteredfetchGuides')->name('filteredfetchGuides');
Route::post('guide/guideDetailView','ApiController@guideDetailView')->name('guideDetailView');
Route::post('guide/guideBooked','ApiController@guideBooked')->name('guideBooked');

Route::get('sightseeing/fetchSightseeing','ApiController@fetchSightseeing')->name('fetchSightseeing');
Route::get('getTourType','ApiController@getTourType')->name('getTourType');
Route::post('sightseeing/filteredfetchSightseeing','ApiController@filteredfetchSightseeing')->name('filteredfetchSightseeing');
Route::post('sightseeing/sightseeingDetailView','ApiController@sightseeingDetailView')->name('sightseeingDetailView');
Route::post('sightseeing/fetchGuidesSightseeing','ApiController@fetchGuidesSightseeing')->name('fetchGuidesSightseeing');
Route::post('sightseeing/fetchDriversSightseeing','ApiController@fetchDriversSightseeing')->name('fetchDriversSightseeing');
Route::post('sightseeing/sightseeingBooked','ApiController@sightseeingBooked')->name('sightseeingBooked');


Route::get('itinerary/fetchItinerary','ApiController@fetchItinerary')->name('fetchItinerary');
Route::post('itinerary/filteredfetchItinerary','ApiController@filteredfetchItinerary')->name('filteredfetchItinerary');
Route::post('itinerary/special_offer','ApiController@special_offer')->name('special_offer');
Route::post('itinerary/special_offer_single','ApiController@special_offer_single')->name('special_offer_single');
Route::post('itinerary/itineraryDetailView','ApiController@itineraryDetailView')->name('itineraryDetailView');
Route::post('itinerary/itineraryBooked','ApiController@itineraryBooked')->name('itineraryBooked');
Route::post('itinerary/itineraryBookedbywordpress','ApiController@itineraryBookedbywordpress')->name('itineraryBookedbywordpress');

Route::post('itinerary/itinerary-get-hotels','ApiController@itinerary_get_hotels')->name('itinerary-get-hotels');
Route::post('itinerary/itinerary-get-hotel-details','ApiController@itinerary_get_hotel_details')->name('itinerary-get-hotels-details');
Route::post('itinerary/itinerary-get-guide-avail','ApiController@itinerary_get_guide_avail')->name('itinerary-get-guide-avail');
Route::post('itinerary/itinerary-get-activities','ApiController@itinerary_get_activities')->name('itinerary-get-activities');
Route::post('itinerary/itinerary-get-sightseeing','ApiController@itinerary_get_sightseeing')->name('itinerary-get-sightseeing');
Route::post('itinerary/itinerary-get-sightseeing-details','ApiController@itinerary_get_sightseeing_details')->name('itinerary-get-sightseeing-details');
Route::post('itinerary/itinerary-get-sightseeing-details-api','ApiController@itinerary_get_sightseeing_details')->name('itinerary-get-sightseeing-details-api');
Route::post('itinerary/itinerary-get-restaurant','ApiController@itinerary_get_restaurant')->name('itinerary-get-restaurant');
Route::post('itinerary/itinerary-get-restaurant-details','ApiController@itinerary_get_restaurant_details')->name('itinerary-get-restaurant-details');
Route::post('itinerary/itinerary-get-transfers','ApiController@itinerary_get_transfers')->name('itinerary-get-transfers');
Route::post('itinerary/itinerary-get-transfers-lastday','ApiController@itinerary_get_transfers_lastday')->name('itinerary-get-transfers-lastday');
Route::post('itinerary/itinerary-get-transfers-pax','ApiController@itinerary_get_transfers_pax')->name('itinerary-get-transfers-pax');

Route::post('itinerary/itinerary-get-vehicle-id','ApiController@get_transfers_vehicle_id')->name('itinerary-get-vehicle-id');

Route::post('itinerary/fetchItineraryGuidesDetails','ApiController@fetchItineraryGuidesDetails')->name('fetchItineraryGuidesDetails');
Route::post('itinerary/fetchItineraryDriversDetails','ApiController@fetchItineraryDriversDetails')->name('fetchItineraryDriversDetails');
Route::post('itinerary/fetchPacakageSubsequentDailyTourCost','ApiController@fetchPacakageSubsequentDailyTourCost')->name('fetchPacakageSubsequentDailyTourCost');

Route::post('transfer/filteredfetchTransfer','ApiController@filteredfetchTransfer')->name('filteredfetchTransfer');
Route::post('transfer/fetchGuidesTransfer','ApiController@fetchGuidesTransfer')->name('fetchGuidesTransfer');
Route::post('transfer/transferDetailView','ApiController@transferDetailView')->name('transferDetailView');
Route::post('transfer/transferBooked','ApiController@transferBooked')->name('transferBooked');


Route::get('restaurant/getRestaurantType','ApiController@getRestaurantType')->name('getRestaurantType');
Route::post('restaurant/filteredfetchRestaurant','ApiController@filteredfetchRestaurants')->name('filteredfetchRestaurant');
Route::post('restaurant/restaurantDetailView','ApiController@restaurantDetailView')->name('restaurantDetailView');
Route::post('restaurant/restaurantBooked','ApiController@restaurantBooked')->name('restaurantBooked');
