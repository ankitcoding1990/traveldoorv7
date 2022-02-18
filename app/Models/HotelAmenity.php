<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelAmenity extends Model
{
    protected $fillable = [
        'hotel_id', 'amenity_id', 'sub_amenity_id', 'status',
    ];

    public function amenities()
    {
        return $this->belongsTo('App\Models\Amenities', 'amenity_id', 'id');
    }

    public function sub_amenities()
    {
        return $this->belongsTo('App\Models\SubAmenities', 'sub_amenity_id', 'id');
    }
}
