<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleType extends Model
{
    use MyModel, SoftDeletes;
    protected $table="vehicle_type";
    public static $imagesPath = 'masters/vehicle-type';

    protected $fillable = [
        'vehicle_type_name',
        'vehicle_type_min',
        'vehicle_type_max',
        'vehicle_type_image',
        'vehicle_type_created_by',
        'vehicle_type_status'
    ];


    public function getVehicles()
    {
    	 return $this->hasMany('App\Models\Vehicles', 'vehicle_type_id','vehicle_type_id');
    }

    public function getImageFullPathAttribute(){
        return asset('storage/uploads/'. self::$imagesPath.'/'.$this->vehicle_type_image);
    }
}
