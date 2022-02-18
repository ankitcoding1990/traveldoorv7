<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantType extends Model
{
    use MyModel, SoftDeletes;
    protected $table="restaurant_types";
    protected $fillable=[
        'restaurant_type_name', 'restaurant_type_status', 'restaurant_type_created_by'
    ];

    // public function scopeActive($query){
    //     return $query->where('type_status',1);
    // }
    function user(){
        return $this->belongsTo('App\User', 'restaurant_type_created_by');
      }
}
