<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelType extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $table="hotel_type";

    protected $fillable = [
        'hotel_type_name',
        'hotel_type_status',
        'hotel_type_created_by',
    ];
    public function scopeActive($query){
return $query->where('hotel_type_status', 1);
    }
    function user(){
        return $this->belongsTo('App\User', 'hotel_type_created_by');
      }
}
