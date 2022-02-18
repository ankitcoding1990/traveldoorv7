<?php

namespace App\Services;

use App\Models\Restaurants;

class RestaurantBookingService
{
    public function search($request)
    {
        $restaurant_type_id=$request->restaurant_type_id;
        $country_id=$request->country_id;
        $city_id=$request->city_id;
        $booking_date=$request->booking_date;
        $booking_time=TwentyFourHourTime($request->booking_time);

        $fetch_restaurants=Restaurants::where('country_id', $country_id)
                                    ->where('city_id', $city_id)
                                    ->where('valid_from_date','<=',$booking_date)
                                    ->where('valid_to_date','>=',$booking_date);

        if($restaurant_type_id!='' || $restaurant_type_id!=null){
            $fetch_restaurants=$fetch_restaurants->where('restaurant_type_id',$restaurant_type_id) ;  
        }    

        $fetch_restaurants=$fetch_restaurants->get();
        $html = view('agent::restaurant.search-filter', compact('fetch_restaurants'));
        return response(['status' => true, 'search_result' => $html->render()]);
    }
}