<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AirportMaster extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $table="airport_masters";

    public function countries(){
        return $this->hasOne('App\Models\Countries','country_id','airport_master_country');
    }
    public function cities(){
        return $this->hasOne('App\Models\Cities','id','airport_master_city');
    }
}
