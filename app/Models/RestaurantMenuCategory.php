<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantMenuCategory extends Model
{
    use MyModel, SoftDeletes;
    // protected $table="restaurant_menu_category";
    protected $fillable=[
        'name','description','status', 'created_by'
    ];
    public function RestaurantFood()
    {
        $this->hasMany('App\Models\RestaurantFood', 'menu_category_id_fk','restaurant_menu_category_id');
    }

    function user(){
        return $this->belongsTo('App\User', 'created_by');
      }
}
