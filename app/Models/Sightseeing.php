<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SightSeeing extends Model
{
    use MyModel, SoftDeletes;
    protected $table = 'sightseeings';
    protected $fillable = [
        'tour_name', 'tour_type', 'tour_desc', 'country_id', 'city_covered', 'from_city_id', 'city_between_ids', 'to_city_id', 'distance_covered', 'duration', 'fuel_type_id', 'food_cost', 'hotel_cost', 'adult_cost', 'child_cost', 'group_adult_cost', 'group_child_cost', 'group_max_pax', 'group_tour_terms', 'default_guide_price', 'additional_cost', 'from_date', 'to_date','discount', 'surge', 'no_of_pax', 'default_driver_price', 'attractions', 'created_admin_id','created_supplier_id', 'show_order', 'status', 'best_status', 'popular_status','admin_approval','is_cloned'
    ];
    public function setCityBetweenIdsAttribute($value){
     if(isset($value) && is_array($value)){
         $this->attributes['city_between_ids'] = json_encode($value, true);
     }
     else{
         $this->attributes['city_between_ids'] = null;
     }
    }
    public function getCityBetweenIdsAttribute($value){
    if($value){
       return json_decode($value, true);
    }
    return null;
    }
    public function betweenCities()
    {
       $bCities = $this->city_between_ids;
       if($bCities){
           return Cities::whereIn('id', $bCities)->get();
          // dd($dd->name);
       }
       return collect([]);
    }
    public function getFromCity()
   {
   	return $this->belongsTo('App\Models\Cities', 'sightseeing_city_from','id');
   }
   public function getToCity()
   {
   	return $this->belongsTo('App\Models\Cities', 'sightseeing_city_to','id');
   }
   public function getCountry()
   {
   	return $this->belongsTo('App\Models\Countries', 'sightseeing_country','country_id');
   }
  public function admin()
  {
      return $this->belongsTo('App\User','created_admin_id','id');
  }
  public function supplier()
  {
        return $this->belongsTo('App\Models\Supplier','created_supplier_id','id');
  }
}
