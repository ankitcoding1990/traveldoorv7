<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use MyModel;
    use SoftDeletes;


    protected $fillable = [
        'activity_type_id',
        'name',
        'supplier_id',
        'location',
        'country_id',
        'city_id',
        'duration',
        'valid_from',
        'valid_to',
        'time_from',
        'time_to',
        'currency',
        'blackout_days',
        'activity_available_days',
        'booking_type',
        'age_groups',
        'inclusions',
        'exclusions',
        'description',
        'cancel_policy',
        'terms_conditions',
        'confirm_message',
        'status',
        'created_user_id',
        'created_supplier_id',
        'is_cloned',
        'approve_status',
        'sort_order',
        'best_seller',
        'popularity_status',
        'draft_status',
    ];

    public function setActivityAvailableDaysAttribute($value)
    {
        if (isset($value) && is_array($value)) {
            $this->attributes['activity_available_days'] = json_encode($value,true);
        }else{
            $this->attributes['activity_available_days'] = null;
        }
    }

    public function getActivityAvailableDaysAttribute($value)
    {
        if($value && $value != null){
            return json_decode($value, true);
        }
    }

    public function setAgeGroupsAttribute($value)
    {
        if (isset($value) && is_array($value)) {
            $this->attributes['age_groups'] = json_encode($value,true);
        }else{
            $this->attributes['age_groups'] = null;
        }
    }

    public function getAgeGroupsAttribute($value)
    {
        if($value != null){
            return json_decode($value, true);
        }
        return null;
    }

    public function activityType()
    {
        return $this->belongsTo('App\Models\ActivityType','activity_type_id','id');
    }

    public function country(){
        return $this->belongsTo('App\Models\Countries', 'country_id','id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\Cities','city_id','id');
    }

    public function pricings()
    {
        return $this->HasMany('App\Models\ActivityPricing','activity_id','id');
    }

    public function booking()
    {
        return $this->hasMany('App\Models\ActivityBooking','activity_id','id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ServiceImages','activity_id','id');
    }

}
