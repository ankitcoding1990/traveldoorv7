<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class States extends Model
{
    use MyModel, SoftDeletes;
    protected $table="states";

    public function getCities(){
       return $this->hasMany('App\Models\Cities', 'state_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Countries','country_id','id');
    }

    public function city()
    {
        return $this->hasMany('App\Models\Cities','state_id','id');
    }


}
