<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurants extends Model
{
    use MyModel, SoftDeletes;
//    protected $table="restaurants";

   public function getRestaurantType()
   {
   	 return $this->belongsTo('App\Models\RestaurantType', 'restaurant_type_id','id');
   }
    public function getSupplier()
   {
   	return $this->belongsTo('App\Models\Supplier', 'supplier_id','id');
   }
   public function getCity()
   {
   	return $this->belongsTo('App\Models\Cities', 'city_id','id');
   }
   public function getCountry()
   {
   	return $this->belongsTo('App\Models\Countries', 'country_id','id');
   }
   protected $fillable = [
       'restaurant_type_id',
       'name',
       'owner_name',
       'contact',
       'email',
       'supplier_id',
       'address',
       'country_id',
       'city_id',
       'valid_from_date',
       'valid_to_date',
       'valid_from_time',
       'valid_to_time',
       'currency',
       'blackout_dates',
       'no_of_tables',
       'restaurant_available_days',
       'description',
       'available_for_delivery',
       'drafted_status',
       'created_user_id',
       'created_supplier_id',
       'approve_status'
   ];

   public function setRestaurantAvailableDaysAttribute($value)
   {
        if (isset($value) && is_array($value)) {
            $this->attributes['restaurant_available_days'] = json_encode($value,true);
        }else{
            $this->attributes['restaurant_available_days'] = null;
        }
   }

   public function getRestaurantAvailableDaysAttribute($value)
   {
        if($value && $value != null){
            return json_decode($value, true);
        }
   }
}
