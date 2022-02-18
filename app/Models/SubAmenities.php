<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubAmenities extends Model
{
    use MyModel, SoftDeletes;
     protected $table="sub_amenities";

     protected $fillable = ['amenities_id','sub_amenities_name','sub_amenities_status','sub_amenities_created_by'];

     public function amenities()
     {
        return $this->belongsTo('App\Models\Amenities','amenities_id','id');
     }
     public function scopeActive($query){
      return $query->where('sub_amenities_status', 1);
     }
}
