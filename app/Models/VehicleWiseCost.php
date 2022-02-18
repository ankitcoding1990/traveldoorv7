<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleWiseCost extends Model
{
    use MyModel, SoftDeletes;

    protected $fillable = ['vehicle_type_id','vehicle_type_cost','vehicle_cost_created_by'];

    public function vehicleTypes()
    {
        return $this->belongsTo('App\Models\VehicleType','vehicle_type_id','id');
    }
}
