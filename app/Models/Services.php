<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
    use MyModel, SoftDeletes;
     protected $table="service";
     public static $imagesPath = 'masters/service-master';

     protected $fillable = ['service_type' ,'service_name','service_description','country_id','city_id','service_image','price_per_pax','price_per_service','service_status','service_created_by'];
    
     public function getImageFullPathAttribute(){
        return asset('storage/uploads/'. self::$imagesPath.'/'.$this->service_image);
    }

    public function country(){
        return $this->belongsTo('App\Models\Countries', 'country_id','id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\Cities','city_id','id');
    }

}
