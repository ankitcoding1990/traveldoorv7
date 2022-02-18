<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuggestedVehiclePrice extends Model
{
    use MyModel, SoftDeletes;
    protected $table="suggested_vehicle_price";

    protected $guarded = [];
}
