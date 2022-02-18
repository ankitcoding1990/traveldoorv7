<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
// dashboard
Route::get('/', 'HomeController@index')->name('index');

// UserAuth
Auth::routes();
Route::group(['module' => 'auth'], function(){
    Route::get('/logout', 'Auth\LogoutController@logout')->name('logout');
    Route::get('user/{id}/profile', 'Auth\ProfileController@show')->name('user.profile');
    Route::put('password/{id}/update', 'Auth\ProfileController@updatePassword')->name('user.profile.password');
});

// UserAuthEnd

// =================================================== without auth ========================================================================
Route::group(['module' => 'components'], function(){
	// -------------------Common Routes For Supplier And Agent Bank
	Route::get('/create-bank/{id}','BankController@createBankForm')->name('supplierBankForm');
	Route::resource('banks', 'BankController');
	// vendor Contacts
	Route::resource('contacts', 'ContactsController');
});

// --------------------HELPER FUNCTIONS & AJAX RENDERING HTML FILES
Route::group(['module' => 'ajax'], function(){

	Route::group(['prefix' => 'ajax','namespace' => 'Ajax'], function(){
        Route::post('/country/cities-render', 'AjaxController@getCitites')->name('country.cities');
        Route::post('/supplier/countries-render', 'AjaxController@getCountries')->name('supplier.countries');
        // activeOrInactive state
        Route::put('/activeOrInactive/{id}/update', 'AjaxController@activeOrInactive')->name('activeOrInactive.update');
	});

	Route::post('/change_state', 'Masters\AmenitiesController@switchState');
	Route::post('/change_supplier_state', 'Suppliers\SupplierManagement@switchState');
	Route::post('/change_agent_state', 'Suppliers\SupplierManagement@switchState');
	Route::post('sub_amenities_state','Masters\SubAmenitiesController@switchState');
	Route::get('/get-cities','Masters\TransferMasterController@getCities');
	Route::post('/vehicle_state', 'Masters\VehicleController@switchState');
	Route::get('/get_states','Masters\CitiesController@getStates');
	Route::get('/generate_coupon','Masters\CouponsController@generateCouponCode');
	Route::get('/coupon_state','Masters\CouponsController@changeState');
	Route::get('/tranfers','MAsters\VehicleSuggestedCostController@Transfers');
	Route::get('/transfer_prices','Masters\VehicleSuggestedCostController@TransferPrices');
	Route::get('/sightseeing_prices','Masters\VehicleSuggestedCostController@SightSeeingPrices');
	Route::get('/pdf_state','Masters\PdfMasterController@changeState');
	Route::get('/search_sight_seeing_Tour_airport','Masters\SuggestedGuideCostController@searchAirportSightseeingCost')->name('search_sight_seeing_Tour_airport');
	Route::get('/get_terms','Masters\ServiceTermsController@getTerms');
	Route::get('/get_enquiry_table','EnquiryManagement\EnquiriesController@getEnquiriesTable')->name('getEnquiryTable');
	Route::get('/get_special_offer_table','EnquiryManagement\EnquiriesController@getSpecialOffersTable')->name('getSpecialOfferTable');
	Route::get('/get_tour_table','EnquiryManagement\EnquiriesController@getTourTable')->name('getTourTable');
	Route::get('/set_assign_to','EnquiryManagement\EnquiriesController@setAssignedTo')->name('assignTo');
	Route::get('/language/state','Masters\LanguagesController@ChangeState');
	Route::get('/vehicle_type/state', 'Masters\VehicleTypeController@ChangeState');
	Route::get('/hotelmeals/state','Masters\HotelMealController@ChangeState');
	Route::get('/vehicle_type_cost/state','Masters\VehicleTypeCostController@ChangeState');
	Route::get('/enquiry_types/state','Masters\EnquiryTypeController@Changestate');
	Route::get('/transfer_masters/state', 'Masters\TransferMasterController@ChangeState');
    Route::get('/user/state', 'Mains\UserManagment\UsersController@ChangeState');
});
// =================================================== / without auth ========================================================================






// Route::resource('profile','ProfileController');
Route::resource('passwordchange', "PasswordChangeController");


// ==================================== /without auth ================================================
Route::group(['middleware' => 'auth'], function(){

		Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

		//============================================USER MANAGEMENTS============================================
		Route::group(['module' => 'UserManagment', 'namespace' => 'UserManagment'], function(){
			Route::resource('users', 'UsersController');
			Route::resource('menus', 'MenusController');
			Route::resource('user-rights', 'UserRightsController');
			Route::post('user-rights/render/html', 'UserRightsController@getUsersRights')->name('user-rights.render.html');
		});
		//============================================END USER MANAGEMENTS============================================

		// Masters Gruop Routes
		Route::group(['module' => 'Masters','namespace' => 'Masters'], function(){
            Route::resource('languages', 'LanguagesController');
            Route::resource('vehicles_types', 'VehicleTypeController');
            Route::resource('hotelmeal', 'HotelMealController');
            Route::resource('vehicles_type_cost', 'VehicleTypeCostController');
            Route::resource('amenities', 'AmenitiesController');
            Route::resource('sub_amenities','SubAmenitiesController');
            Route::resource('guide_expenses','GuideExpensesController');
            Route::resource('enquiry_type','EnquiryTypeController');
            Route::resource('transfer_master','TransferMasterController');
            Route::resource('tour_type','TourTypeController');
            Route::resource('hotel_type','HotelTypeController');
            Route::resource('activity_type','ActivityTypeController');
            Route::resource('vehicle','VehicleController');
            Route::resource('cities', 'CitiesController');
            Route::resource('customer_markup','CustomerMarkupController');
            Route::resource('target_commission','TargetCommissionController');
            Route::resource('special_offers','SpecialOffersController');
            Route::resource('service_master','ServiceMasterController');
            Route::resource('acceptance_master','AcceptancePdfController');
            Route::resource('suggested_cost_guide','SuggestedGuideCostController');
            Route::resource('coupon', 'CouponsController');
            Route::resource('pdf_master','PdfMasterController');
            Route::resource('vehicle_suggested_cost','VehicleSuggestedCostController');
            Route::resource('service_terms','ServiceTermsController');
            Route::resource('countries', 'CountriesController');
            Route::get('/search-country-cities','SuggestedGuideCostController@searchAirportSightseeingCost')->name('search-country-cities');
		});
		//Income Expense Routes
		Route::group(['module' => 'IncomeExpense' , 'namespace' => 'IncomeExpense'], function(){
		    Route::resource('expense','ExpenseController');
		    Route::resource('incomes','IncomeController');
		    Route::resource('office_income','OfficeIncomeController');
		    Route::resource('office_expense','OfficeExpenseController');
		});
		Route::group(['module' => 'restaurants','namespace' => 'Restaurants'],function(){
			Route::resource('restaurant-types','Restaurant_TypeController');
			Route::resource('restaurant-categories','Restaurant_Menu_CategoryController');
			Route::resource('restaurant-foods','Restaurant_FoodController');
		});
});



//============================================SUPPLIER============================================
Route::group(['module' => 'suppliers'], function(){
	Route::resource('suppliers', 'Suppliers\SupplierManagement');
	Route::get('/supplier-bank/{id}','Suppliers\SupplierManagement@bankIndex')->name('suppliers.bank');
	Route::get('/supplier-services/{id}','Suppliers\SupplierManagement@serviceIndex')->name('suppliers.service');
	Route::get('/supplier-contact-persons/{id}','Suppliers\SupplierManagement@contactPersonIndex')->name('suppliers.contactperson');
	Route::get('/supplier-password-change/{id}','Suppliers\SupplierManagement@changePasswordIndex')->name('suppliers.changePassword');
	Route::post('suppliers/active-inactive','SupplierManagement@updateSupplierActiveInactive')->name('suppliers.active-inactive');
 	Route::post('suppliers/change-password','SupplierManagement@changePassword')->name('suppliers.change-password');
});
//============================================END SUPPLIER============================================


//============================================AGENTS============================================
Route::group(['module' => 'agents'], function(){
	Route::resource('agents', 'AgentManagement');
	Route::post('/update/agent-active','AgentManagement@update_agent_active_inactive')->name('agents.active');
	Route::get('/agents/{id}/bank','AgentManagement@bankIndex')->name('agents.bank');
	Route::get('/agents/{id}/services','AgentManagement@servicesIndex')->name('agents.services');
	Route::get('/agents/{id}/contacts','AgentManagement@contactsIndex')->name('agents.contacts');
	// Route::get('/agents/{id}/password','AgentManagement@passwordIndex')->name('agents.password');
	// Route::post('/agent/change-password','AgentManagement@change_password')->name('agents.change-password');
	// Route::post('/agent-change-password','AgentManagement@change_password')->name('agent-change-password');
	Route::get('/agent/{id}/password','AgentManagement@changePasswordIndex')->name('agents.changePassword');
	Route::post('/agent/{id}/password','AgentManagement@changePasswordIndex')->name('agents.changePassword.update');

});
//============================================END AGENTS============================================

//Enquiry Management Routes

Route::group(['module' => 'EnquiryManagement','namespace' => 'EnquiryManagement'],function(){
    Route::resource('enquiries','EnquiriesController');
});

//Service Management
Route::group(['module' => 'ServiceManagement','namespace' => 'ServiceManagement', 'prefix' => 'services'],function(){

		//sightseeings
		Route::group(['module' => 'sightseeings'], function(){
				Route::resource('sightseeings','SightSeeingServiceController');
				Route::get('sightseeings/{id}/description','SightSeeingServiceController@descriptionCreate')->name('sightseeings.description.create');
				Route::post('sightseeings/{id}/description','SightSeeingServiceController@descriptionStore')->name('sightseeings.description.store');
				Route::get('sightseeings/{id}/images','SightSeeingServiceController@imagesUploadIndex')->name('sightseeings.images.upload');
				Route::post('sightseeings/{id}/images','SightSeeingServiceController@imagesStore')->name('sightseeings.images.store');
				Route::get('sightseeings/{id}/prices','SightSeeingServiceController@pricesCreate')->name('sightseeings.prices.create');
				Route::post('sightseeings/{id}/prices','SightSeeingServiceController@pricesStore')->name('sightseeings.prices.store');
				Route::get('sightseeings/prices/edit','SightSeeingServiceController@pricesEdit')->name('sightseeings.prices.edit');
				Route::get('sightseeings/drafted/list','SightSeeingServiceController@drafted')->name('sightseeings.drafted');
		});
		// activities
		Route::group(['module' => 'activities'], function(){
				Route::resource('activities','ActivityServiceController');
                Route::resource('activity.prices', 'ActivityPricingController');
                Route::resource('activity.booking', 'ActivityBookingController');
				Route::get('activity/description/{id}/create','ActivityServiceController@descriptionCreate')->name('activity.description.create');
                Route::post('activity-description-store','ActivityServiceController@descriptionStore')->name('description.store');
                Route::get('activity/description/{id}/edit','ActivityServiceController@descriptionEdit')->name('activity.description.edit');
                Route::put('activity-description-update','ActivityServiceController@descriptionUpdate')->name('description.update');
                Route::get('activities-drafted','ActivityServiceController@drafted')->name('activity-draft');
                Route::get('activity/image/{id}/upload','ActivityServiceController@ImageUploadIndex')->name('activity-img-upload');
                Route::post('activity/images','ActivityServiceController@AcitivityImages')->name('activity-img');
				Route::get('activity/image/{id}/edit','ActivityServiceController@ImageEditIndex')->name('activity-img-edit');
				Route::put('activity/images/update','ActivityServiceController@AcitivityImagesUpdate')->name('activity-img-update');
		});
		// Restaurants
		Route::group(['module' => 'restaurants'], function(){
				Route::resource('restaurants','RestaurantsServiceController');
				Route::get('restaurant/drafted/list','RestaurantsServiceController@index_drafted')->name('restaurant.drafted');
                Route::get('restaurant/{id}/images/create','RestaurantsServiceController@create_image')->name('restaurant.images.create');
                Route::get('restaurant/{id}/images/edit','RestaurantsServiceController@edit_image')->name('restaurant.images.edit');
                Route::get('restaurant/{id}/images/store','RestaurantsServiceController@store_image')->name('restaurant.images.store');
		});

		Route::group(['module' => 'hotels'], function(){
			Route::resource('hotels','HotelServiceController');
			Route::get('hotels/drafted/list','HotelServiceController@drafted')->name('hotels.drafted');
            Route::get('hotels/{id}/amenities','HotelServiceController@amenitiesCreate')->name('hotels.amenities.create');
            Route::post('hotels/{id}/amenities','HotelServiceController@amenitiesStore')->name('hotels.amenities.store');
            Route::get('hotels/{id}/description','HotelServiceController@descriptionCreate')->name('hotels.description.create');
            Route::post('hotels/{id}/description','HotelServiceController@descriptionStore')->name('hotels.description.store');
            Route::get('hotels/{id}/images','HotelServiceController@imagesUploadIndex')->name('hotels.images.upload');
            Route::post('hotels/{id}/images','HotelServiceController@imagesStore')->name('hotels.images.store');
            Route::get('hotels/{id}/rooms','HotelServiceController@roomCreate')->name('hotels.rooms.create');
            Route::post('hotels/{id}/rooms','HotelServiceController@roomStore')->name('hotels.rooms.store');
            // Hotel Edit Routes
            Route::get('hotels/{id}/amenities/edit','HotelServiceController@amenitiesEdit')->name('hotels.amenities.edit');
            Route::put('hotels/{id}/amenities/update','HotelServiceController@amenitiesUpdate')->name('hotels.amenities.update');
            Route::get('hotels/{id}/description/edit','HotelServiceController@descriptionEdit')->name('hotels.description.edit');
            Route::put('hotels/{id}/description/update','HotelServiceController@descriptionUpdate')->name('hotels.description.update');
            Route::get('hotels/{id}/images/edit','HotelServiceController@imagesUploadEdit')->name('hotels.images.edit');
            Route::put('hotels/{id}/images/update','HotelServiceController@imagesUpdate')->name('hotels.images.update');
		});


        Route::resource('guides','GuideServiceController');
        Route::resource('transfers','TransferServiceController');
        Route::resource('drivers','DriverServiceController');

});

Route::group(['module' => 'AjaxRequest', 'namespace' => 'ServiceManagement'],function(){
    Route::post('activity-basic','ActivityServiceController@basicActivityStore')->name('basic-activity');
    Route::post('activity-pricing','ActivityServiceController@pricingActivityStore')->name('pricing-activity');
    Route::post('activity-description','ActivityServiceController@descriptionActivityStore')->name('description-activity');
    Route::get('get-supplier-country','ActivityServiceController@SupplierCountries');
    Route::get('service/activity/copy/{id}','ActivityServiceController@cloneActivity')->name('clone.activity');
    Route::post('activity/state','ActivityServiceController@changeStatus');
    Route::match(['put', 'post'],'service/post-images','ImageUploadController@PostImages')->name('service-image.post');
    Route::get('service/get-images','ImageUploadController@GetImages')->name('service-image.get');
    Route::get('service/delete-image','ImageUploadController@DeleteImages')->name('service-image.delete');
    Route::post('restaurant/change/status','RestaurantsServiceController@changeStatus')->name('restaurant.approve.status');
    Route::post('sightseeing/state','SightSeeingServiceController@changeStatus')->name('sightseeings.state');
    Route::post('hotel/state', 'HotelServiceController@changeStatus')->name('hotels.state');

});



// =================================================================================================================================
//** below routes not confirmed that is used or not
// =================================================================================================================================

// Route::post('update-restaurant-active','Restaurants\Restaurant_ManagementController@activeOrInactive');
// Route::get('/get_countries','Restaurants\Restaurant_ManagementController@countries');
// Route::get('/get_cities','Restaurants\Restaurant_ManagementController@cities');
// Route::get('/getcities','Suppliers\SupplierManagement@getcities');
