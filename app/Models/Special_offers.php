<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Special_offers extends Model
{
    use MyModel, SoftDeletes;
    protected $table="special_offers";

    protected $fillable = [
        'title',
        'status',
        'description',
        'image',
        'package',
        'price',
        'price_child',
        'price_infant',
        'itinerary_id',
        'inclusions',
        'exclusions',
    ];
}
