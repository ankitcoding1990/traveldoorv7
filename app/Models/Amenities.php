<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenities extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $table="amenities";

    protected $fillable = [
        'amenities_name',
        'amenities_status',
        'amenities_created_by'
    ];

    public function sub_amenities(){
        return $this->hasMany('App\Models\SubAmenities','amenities_id', 'id');
    }
    public function scopeActive($query){
        return $query->where('amenities_status', 1);
    }

}
