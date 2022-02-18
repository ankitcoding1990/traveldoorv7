<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cities extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $table="cities";

    protected $fillable = [
        'name',
        'state_id',
        'city_status',
    ];
    public function scopeActive($query){
        return $query->where('city_status',1);
    }

    public function getCities()
    {
        return $this->hasMany('App\Models\TranferMaster','master_city', 'id');
    }

    public function states()
    {
        return $this->belongsTo('App\Models\States','state_id','id');
    }

}
