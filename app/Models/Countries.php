<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Countries extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $table="countries";

    protected $fillable =[
        'country_name',
        'country_abbr',
        'country_code',
    ];

    public function getCountries()
    {
        return $this->hasMany('App\Models\TransferMaster','master_country','country_id');
    }

    public function state()
    {
        return $this->hasMany('App\Models\States','id','country_id');
    }

    public function cities()
    {
        return $this->hasManyThrough('App\Models\Cities','App\Models\States','country_id','state_id', 'id','id');
    }

    public function activity()
    {
        return $this->hasMany('App\Models\Activity','country_id','id');
    }
}
