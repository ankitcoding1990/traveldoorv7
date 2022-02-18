<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantFood extends Model
{
    use MyModel, SoftDeletes;
    protected $table="restaurants_food";
    public function getMenuCategory()
    {
        return $this->belongsTo('App\Models\RestaurantMenuCategory', 'menu_category_id_fk','restaurant_menu_category_id');
    }
    public function getRestaurant()
    {
        return $this->belongsTo('App\Models\Restaurants', 'restaurant_id_fk','restaurant_id');
    }
    protected $fillable = [
        'food_created_by','restaurant_id_fk','menu_category_id_fk','food_name',
        'food_price','food_discounted_price','food_unit','food_package_count',
        'food_type','food_featured','food_ingredients','food_images','food_role',
        'food_approval_status','food_available_for_delivery'
    ];
}
