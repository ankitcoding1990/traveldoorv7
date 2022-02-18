<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicles extends Model
{
    use MyModel, SoftDeletes;
    protected $table="vehicle";

    protected $fillable = [
        'vehicle_type_id',
        'vehicle_name',
        'vehicle_status',
        'vehicle_created_by',
        'vehicle_created_role',
    ];


    public function vehicle_type()
    {
    	return $this->belongsto('App\Models\VehicleType','vehicle_type_id','id');
    }
}
