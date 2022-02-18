<?php

use App\Models\Menu;
use App\User;
use App\Models\Languages;
use App\Models\UserRight;
use App\Models\EnquiryType;
use App\Models\FuelType;
use App\Models\Agent;
use App\Models\Cities;
use App\Models\Nationalities;
use App\Models\SavedItinerary;
use App\Models\Currency;
use App\Models\Supplier;
use App\Models\Countries;
use App\Models\OurService;
use App\Models\ActivityType;
use App\Models\AgentService;
use App\Models\Amenities;
use App\Models\HotelType;
use App\Models\RestaurantType;
use App\Models\SuggestedVehiclePrice;
use App\Models\SupplierService;
use App\Models\TourType;
use App\Models\VehicleType;

function userRoles(){
  return collect([
    'partner' => 'Partner',
    'subuser'  => 'Sub User'
  ]);
}
function getHotelType(){
  return HotelType::active()->orderBy('hotel_type_name', 'asc')->get();
}
function getCountryCity($countryId){
  return Cities::getCountryWiseCities($countryId);
}
function getFuelType(){
  return FuelType::active()->orderBy('fuel_type', 'asc')->get();
}
function getTourType(){
  return TourType::active()->orderBy('tour_type_name', 'asc')->get();
}
function getRestaurantType(){
  return RestaurantType::orderBy('restaurant_type_name', 'asc')->get();
}
function getLanguages(){
  return Languages::active()->orderBy('language_name', 'asc')->get();
}
function activeCities(){
  return Cities::active()->orderBy('name', 'asc')->get();
}
function getSelectedCity($id){
  return Cities::where('id', $id)->first();
}
function activeCurrencies($id = null){
    if($id != null){
        return Currency::where('id',$id)->first();
    }
    else{
        return Currency::active()->orderBy('name','asc')->get();
    }
}
function ourServices(){
  return OurService::orderBy('name', 'asc')->get();
}
function activeServices(){
  return OurService::active()->orderBy('name', 'asc')->get();
}

function getActiveMenus($id = null){
  $query = Menu::where('status', 1);
  if($query){
    $query = $query->where('id', $id);
  }
  return $query->get();
}
function getActiveParentMenus($parentId = null){
  $query = Menu::where('status', 1)->whereNull('menu_pid');
  if($parentId != null){
    $query = $query->where('menu_pid', $parentId);
  }
  return $query->get();
}
function fetch_user($userId){
  return User::where('users_id', $userId)->first();
}
function hasRoute($menu){

}

function countries($id = null){
    if($id != null){
        return Countries::where('id',$id)->first();
    }
    else{
        return Countries::get();
    }
}
    function getActiveItinaries($id = null)
    {
        if($id == null){
            return SavedItinerary::where('itinerary_status','1')->pluck('itinerary_tour_name','itinerary_id');
        }
        else{
            return SavedItinerary::where('itinerary_status','1')->where('itinerary_id',$id)->pluck('itinerary_tour_name','itinerary_id');
        }
    }

    function getCountries($active = null){
        if($active){
            $countries = Countries::where('status',1)->pluck('country_name','id');
        }
        else{
            $countries = Countries::all()->pluck('country_name','id');
        }

        return $countries;
    }

    function suggestedVehicleCost($sightseeing_id,$vehicle_type_id)
    {
        return App\SuggestedVehiclePrice::where('tour_id', $sightseeing_id)->where('vehicle_type_id', $vehicle_type_id)->first();
    }

    function suggestedGuideCost($airport_master_id,$vehicle_type_id)
    {
        return App\SuggestedAirportPrice::where('airport_id', $airport_master_id)->where('vehicle_type_id', $vehicle_type_id)->first();
    }

    function getSuggestedVehiclePrice($sightseeing_id,$vehicle_type_id){
        return SuggestedVehiclePrice::where('tour_id', $sightseeing_id)->where('vehicle_type_id', $vehicle_type_id)->first();
    }

    function getEnquiriesType()
    {
        return EnquiryType::all()->pluck('enquiry_type_name','enquiry_type_id');
    }

    function getUsersList()
    {
        return User::all()->pluck('name','id');
    }

    function getSpecificCountry($country_id)
    {
        return Countries::where('country_id',$country_id)->first();
    }

    function getSpecificUser($user_id)
    {
        return User::where('id',$user_id)->first();
    }
    function getNationalities()
    {
        return Nationalities::all()->pluck('nationality','nationality');
    }
    function weeks(){
        return [
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday',
        ];
    }
    function getAgentServices($id,$type = null)
    {
      if($type == 'agent') {
        return AgentService::where('agent_id',$id)->get();
      } else if ($type == 'supplier') {
        return SupplierService::where('supplier_id',$id)->get();
      }
    }
    function getServiceName($id)
    {
      return OurService::where('id',$id)->first();
    }

    function getAgent($id = null){
      if ($id != null) {
        return Agent::find($id);
      }
      return null;
    }
    function getAgentAuth(){
      if (auth()->guard('agent')->check()) {
          return auth()->guard('agent')->user();
      }
      return false;
    }
    function checkAgentAuth(){
      return auth()->guard('agent')->check();
    }
    function getActivityTypes(){
        return ActivityType::all();
    }

    function TwentyFourHourTime($value){
        $time = date('H:i',strtotime($value));
        return $time;
    }
    function TwelveHourTime($value){
        $time = date('h:i a',strtotime($value));
        return $time;
    }
    function getSuppliers($id = null){
        if($id != null){
            return Supplier::where('id',$id)->where('status',null)->first();
        }
        else{
            return Supplier::where('status',null)->get();
        }
    }

    function getVehicleTypes(){
        return VehicleType::get();
    }

    function getActiveAmenities($active = null)
    {
        if($active != null){
            $amenities = Amenities::where('amenities_status',1)->get();
        }
        else{
            $amenities = Amenities::get();
        }
        return $amenities;
    }

?>
