<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelMeal extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $table="hotel_meals";

    protected $fillable = [
        'hotel_meals_name',
        'hotel_meals_status',
        'hotel_meals_created_by'
    ];
}
