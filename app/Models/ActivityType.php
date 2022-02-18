<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityType extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $table = 'activity_type';

    protected $fillable = [
        'activity_type_name',
        'activity_type_status',
        'activity_type_created_by'
    ];

    public function activities()
    {
        return $this->hasMany('App\Models\Activity','activity_type_id','id');
    }
    function user(){
        return $this->belongsTo('App\User', 'activity_type_created_by');
    }
}
