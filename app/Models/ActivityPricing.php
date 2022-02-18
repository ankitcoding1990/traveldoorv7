<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityPricing extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $fillable = [
        'activity_id',
        'pricing_for',
        'min_pax',
        'max_pax',
        'price',
    ];
}
